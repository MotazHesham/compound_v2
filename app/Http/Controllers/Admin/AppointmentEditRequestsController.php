<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentEditRequestRequest;
use App\Http\Requests\StoreAppointmentEditRequestRequest;
use App\Http\Requests\UpdateAppointmentEditRequestRequest;
use App\Models\Appointment;
use App\Models\AppointmentEditRequest;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentEditRequestsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('appointment_edit_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AppointmentEditRequest::with(['user', 'appointment'])->select(sprintf('%s.*', (new AppointmentEditRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_edit_request_show';
                $editGate      = 'appointment_edit_request_edit';
                $deleteGate    = 'appointment_edit_request_delete';
                $crudRoutePart = 'appointment-edit-requests';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('appointment_date', function ($row) {
                return $row->appointment ? $row->appointment->date : '';
            });

            $table->editColumn('time', function ($row) {
                return $row->time ? $row->time : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? AppointmentEditRequest::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'appointment']);

            return $table->make(true);
        }

        return view('admin.appointmentEditRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_edit_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointments = Appointment::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointmentEditRequests.create', compact('appointments', 'users'));
    }

    public function store(StoreAppointmentEditRequestRequest $request)
    {
        $appointmentEditRequest = AppointmentEditRequest::create($request->all());

        return redirect()->route('admin.appointment-edit-requests.index');
    }

    public function edit(AppointmentEditRequest $appointmentEditRequest)
    {
        abort_if(Gate::denies('appointment_edit_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointments = Appointment::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointmentEditRequest->load('user', 'appointment');

        return view('admin.appointmentEditRequests.edit', compact('appointmentEditRequest', 'appointments', 'users'));
    }

    public function update(UpdateAppointmentEditRequestRequest $request, AppointmentEditRequest $appointmentEditRequest)
    {
        $appointmentEditRequest->update($request->all());

        return redirect()->route('admin.appointment-edit-requests.index');
    }

    public function show(AppointmentEditRequest $appointmentEditRequest)
    {
        abort_if(Gate::denies('appointment_edit_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentEditRequest->load('user', 'appointment');

        return view('admin.appointmentEditRequests.show', compact('appointmentEditRequest'));
    }

    public function destroy(AppointmentEditRequest $appointmentEditRequest)
    {
        abort_if(Gate::denies('appointment_edit_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentEditRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentEditRequestRequest $request)
    {
        $appointmentEditRequests = AppointmentEditRequest::find(request('ids'));

        foreach ($appointmentEditRequests as $appointmentEditRequest) {
            $appointmentEditRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}