@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.appointmentCovenant.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointment-covenants.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="appointment_id">{{ trans('cruds.appointmentCovenant.fields.appointment') }}</label>
                <select class="form-control select2 {{ $errors->has('appointment') ? 'is-invalid' : '' }}" name="appointment_id" id="appointment_id">
                    @foreach($appointments as $id => $entry)
                        <option value="{{ $id }}" {{ old('appointment_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('appointment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentCovenant.fields.appointment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="covenant_id">{{ trans('cruds.appointmentCovenant.fields.covenant') }}</label>
                <select class="form-control select2 {{ $errors->has('covenant') ? 'is-invalid' : '' }}" name="covenant_id" id="covenant_id">
                    @foreach($covenants as $id => $entry)
                        <option value="{{ $id }}" {{ old('covenant_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('covenant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('covenant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentCovenant.fields.covenant_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.appointmentCovenant.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appointmentCovenant.fields.quantity_helper') }}</span>
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