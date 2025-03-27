@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.appointmentEditRequest.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.appointment-edit-requests.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.appointmentEditRequest.fields.id') }}
                            </th>
                            <td>
                                {{ $appointmentEditRequest->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.appointmentEditRequest.fields.user') }}
                            </th>
                            <td>
                                {{ $appointmentEditRequest->user->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.appointmentEditRequest.fields.appointment') }}
                            </th>
                            <td>
                                {{ $appointmentEditRequest->appointment->date ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.appointmentEditRequest.fields.date') }}
                            </th>
                            <td>
                                {{ $appointmentEditRequest->date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.appointmentEditRequest.fields.time') }}
                            </th>
                            <td>
                                {{ $appointmentEditRequest->time }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.appointmentEditRequest.fields.status') }}
                            </th>
                            <td>
                                {{ App\Models\AppointmentEditRequest::STATUS_SELECT[$appointmentEditRequest->status] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.appointmentEditRequest.fields.reject_reason') }}
                            </th>
                            <td>
                                {{ $appointmentEditRequest->reject_reason }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.appointment-edit-requests.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
