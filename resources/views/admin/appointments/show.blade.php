@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <td>
                            {{ $appointment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Appointment::TYPE_SELECT[$appointment->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.date') }}
                        </th>
                        <td>
                            {{ $appointment->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.time') }}
                        </th>
                        <td>
                            {{ $appointment->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Appointment::STATUS_SELECT[$appointment->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.finish_code') }}
                        </th>
                        <td>
                            {{ $appointment->finish_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.problem_description') }}
                        </th>
                        <td>
                            {{ $appointment->problem_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.problem_photos') }}
                        </th>
                        <td>
                            @foreach($appointment->problem_photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.review') }}
                        </th>
                        <td>
                            {{ $appointment->review }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.cancel_reason') }}
                        </th>
                        <td>
                            {{ $appointment->cancel_reason }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.arrived_lat') }}
                        </th>
                        <td>
                            {{ $appointment->arrived_lat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.arrived_lng') }}
                        </th>
                        <td>
                            {{ $appointment->arrived_lng }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.contract') }}
                        </th>
                        <td>
                            {{ $appointment->contract->start_date ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.client') }}
                        </th>
                        <td>
                            {{ $appointment->client->address ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appointment.fields.technician') }}
                        </th>
                        <td>
                            @foreach($appointment->technicians as $key => $technician)
                                <span class="label label-info">{{ $technician->identity_num }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.appointments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#appointment_appointment_covenants" role="tab" data-toggle="tab">
                {{ trans('cruds.appointmentCovenant.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="appointment_appointment_covenants">
            @includeIf('admin.appointments.relationships.appointmentAppointmentCovenants', ['appointmentCovenants' => $appointment->appointmentAppointmentCovenants])
        </div>
    </div>
</div>

@endsection