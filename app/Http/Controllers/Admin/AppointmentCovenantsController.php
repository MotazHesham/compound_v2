<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentCovenantRequest;
use App\Http\Requests\StoreAppointmentCovenantRequest;
use App\Http\Requests\UpdateAppointmentCovenantRequest;
use App\Models\Appointment;
use App\Models\AppointmentCovenant;
use App\Models\Covenant;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentCovenantsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('appointment_covenant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AppointmentCovenant::with(['appointment', 'covenant'])->select(sprintf('%s.*', (new AppointmentCovenant)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_covenant_show';
                $editGate      = 'appointment_covenant_edit';
                $deleteGate    = 'appointment_covenant_delete';
                $crudRoutePart = 'appointment-covenants';

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
            $table->addColumn('appointment_date', function ($row) {
                return $row->appointment ? $row->appointment->date : '';
            });

            $table->addColumn('covenant_name', function ($row) {
                return $row->covenant ? $row->covenant->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'appointment', 'covenant']);

            return $table->make(true);
        }

        return view('admin.appointmentCovenants.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_covenant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $covenants = Covenant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointmentCovenants.create', compact('appointments', 'covenants'));
    }

    public function store(StoreAppointmentCovenantRequest $request)
    {
        $appointmentCovenant = AppointmentCovenant::create($request->all());

        return redirect()->route('admin.appointment-covenants.index');
    }

    public function edit(AppointmentCovenant $appointmentCovenant)
    {
        abort_if(Gate::denies('appointment_covenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $covenants = Covenant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointmentCovenant->load('appointment', 'covenant');

        return view('admin.appointmentCovenants.edit', compact('appointmentCovenant', 'appointments', 'covenants'));
    }

    public function update(UpdateAppointmentCovenantRequest $request, AppointmentCovenant $appointmentCovenant)
    {
        $appointmentCovenant->update($request->all());

        return redirect()->route('admin.appointment-covenants.index');
    }

    public function show(AppointmentCovenant $appointmentCovenant)
    {
        abort_if(Gate::denies('appointment_covenant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentCovenant->load('appointment', 'covenant');

        return view('admin.appointmentCovenants.show', compact('appointmentCovenant'));
    }

    public function destroy(AppointmentCovenant $appointmentCovenant)
    {
        abort_if(Gate::denies('appointment_covenant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentCovenant->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentCovenantRequest $request)
    {
        $appointmentCovenants = AppointmentCovenant::find(request('ids'));

        foreach ($appointmentCovenants as $appointmentCovenant) {
            $appointmentCovenant->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
