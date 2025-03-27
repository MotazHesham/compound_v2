@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointmentEditRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointment-edit-requests.update", [$appointmentEditRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.appointmentEditRequest.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $appointmentEditRequest->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentEditRequest.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="appointment_id">{{ trans('cruds.appointmentEditRequest.fields.appointment') }}</label>
                <select class="form-control select2 {{ $errors->has('appointment') ? 'is-invalid' : '' }}" name="appointment_id" id="appointment_id" required>
                    @foreach($appointments as $id => $entry)
                        <option value="{{ $id }}" {{ (old('appointment_id') ? old('appointment_id') : $appointmentEditRequest->appointment->id ?? '') == $id ? 'selected' : '' }}>{{ $id }}</option>
                    @endforeach
                </select>
                @if($errors->has('appointment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentEditRequest.fields.appointment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.appointmentEditRequest.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $appointmentEditRequest->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentEditRequest.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="time">{{ trans('cruds.appointmentEditRequest.fields.time') }}</label>
                <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', $appointmentEditRequest->time) }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentEditRequest.fields.time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.appointmentEditRequest.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppointmentEditRequest::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $appointmentEditRequest->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentEditRequest.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reject_reason">{{ trans('cruds.appointmentEditRequest.fields.reject_reason') }}</label>
                <textarea class="form-control {{ $errors->has('reject_reason') ? 'is-invalid' : '' }}" name="reject_reason" id="reject_reason">{{ old('reject_reason', $appointmentEditRequest->reject_reason) }}</textarea>
                @if($errors->has('reject_reason'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reject_reason') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentEditRequest.fields.reject_reason_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection