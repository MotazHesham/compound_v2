<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Technician;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Appointment::with(['contract', 'client', 'technicians'])->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_show';
                $editGate      = 'appointment_edit';
                $deleteGate    = 'appointment_delete';
                $crudRoutePart = 'appointments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Appointment::TYPE_SELECT[$row->type] : '';
            });

            $table->editColumn('time', function ($row) {
                return $row->time ? $row->time : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Appointment::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('problem_description', function ($row) {
                return $row->problem_description ? $row->problem_description : '';
            });
            $table->editColumn('problem_photos', function ($row) {
                if (! $row->problem_photos) {
                    return '';
                }
                $links = [];
                foreach ($row->problem_photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('cancel_reason', function ($row) {
                return $row->cancel_reason ? $row->cancel_reason : '';
            });
            $table->addColumn('contract_start_date', function ($row) {
                return $row->contract ? $row->contract->start_date : '';
            });

            $table->addColumn('client_address', function ($row) {
                return $row->client ? $row->client->address : '';
            });

            $table->editColumn('technician', function ($row) {
                $labels = [];
                foreach ($row->technicians as $technician) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $technician->identity_num);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'problem_photos', 'contract', 'client', 'technician']);

            return $table->make(true);
        }

        return view('admin.appointments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contracts = Contract::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('address', 'id')->prepend(trans('global.pleaseSelect'), '');

        $technicians = Technician::pluck('identity_num', 'id');

        return view('admin.appointments.create', compact('clients', 'contracts', 'technicians'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());
        $appointment->technicians()->sync($request->input('technicians', []));
        foreach ($request->input('problem_photos', []) as $file) {
            $appointment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('problem_photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $appointment->id]);
        }

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contracts = Contract::pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('address', 'id')->prepend(trans('global.pleaseSelect'), '');

        $technicians = Technician::pluck('identity_num', 'id');

        $appointment->load('contract', 'client', 'technicians');

        return view('admin.appointments.edit', compact('appointment', 'clients', 'contracts', 'technicians'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());
        $appointment->technicians()->sync($request->input('technicians', []));
        if (count($appointment->problem_photos) > 0) {
            foreach ($appointment->problem_photos as $media) {
                if (! in_array($media->file_name, $request->input('problem_photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $appointment->problem_photos->pluck('file_name')->toArray();
        foreach ($request->input('problem_photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $appointment->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('problem_photos');
            }
        }

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('contract', 'client', 'technicians', 'appointmentAppointmentCovenants');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        $appointments = Appointment::find(request('ids'));

        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('appointment_create') && Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Appointment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
