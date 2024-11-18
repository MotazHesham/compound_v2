@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contract.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contracts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required" for="client_id">{{ trans('cruds.contract.fields.client') }}</label>
                    <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                        @foreach($clients as $id => $entry)
                            <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('client'))
                        <div class="invalid-feedback">
                            {{ $errors->first('client') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contract.fields.client_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="start_date">{{ trans('cruds.contract.fields.start_date') }}</label>
                    <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                    @if($errors->has('start_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contract.fields.start_date_helper') }}</span>
                </div>
                {{-- <div class="form-group col-md-3">
                    <label class="required" for="end_date">{{ trans('cruds.contract.fields.end_date') }}</label>
                    <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date') }}" required>
                    @if($errors->has('end_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contract.fields.end_date_helper') }}</span>
                </div> --}}
                <div class="form-group col-md-3">
                    <label class="required" for="num_of_visits">{{ trans('cruds.contract.fields.num_of_visits') }}</label>
                    <input class="form-control {{ $errors->has('num_of_visits') ? 'is-invalid' : '' }}" type="number" name="num_of_visits" id="num_of_visits" value="{{ old('num_of_visits', '12') }}" step="1" required  readonly>
                    @if($errors->has('num_of_visits'))
                        <div class="invalid-feedback">
                            {{ $errors->first('num_of_visits') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contract.fields.num_of_visits_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="chosen_day">{{ trans('cruds.contract.fields.chosen_day') }}</label>
                    <input class="form-control {{ $errors->has('chosen_day') ? 'is-invalid' : '' }}" type="number" name="chosen_day" id="chosen_day" value="{{ old('chosen_day', '') }}" step="1" min="1" max="31" required>
                    @if($errors->has('chosen_day'))
                        <div class="invalid-feedback">
                            {{ $errors->first('chosen_day') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contract.fields.chosen_day_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required">{{ trans('cruds.contract.fields.time') }}</label>
                    <select class="form-control {{ $errors->has('time') ? 'is-invalid' : '' }}" name="time" id="time" required>
                        <option value disabled {{ old('time', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Appointment::TIMES_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('time', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('time'))
                        <div class="invalid-feedback">
                            {{ $errors->first('time') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contract.fields.time_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="technicians">{{ trans('cruds.appointment.fields.technician') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('technicians') ? 'is-invalid' : '' }}" name="technicians[]" id="technicians" multiple>
                        @foreach($technicians as $id => $technician)
                            <option value="{{ $id }}" {{ (in_array($id, old('technicians', []))) ? 'selected' : '' }}>{{ $technician }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('technicians'))
                        <div class="invalid-feedback">
                            {{ $errors->first('technicians') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.technician_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="services">{{ trans('cruds.contract.fields.services') }}</label>
                    <textarea class="form-control {{ $errors->has('services') ? 'is-invalid' : '' }}" name="services" id="services">{{ old('services') }}</textarea>
                    @if($errors->has('services'))
                        <div class="invalid-feedback">
                            {{ $errors->first('services') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contract.fields.services_helper') }}</span>
                </div>
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