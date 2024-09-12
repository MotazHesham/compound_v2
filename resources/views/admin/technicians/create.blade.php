@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.technician.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.technicians.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.technician.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.technician.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="technician_type_id">{{ trans('cruds.technician.fields.technician_type') }}</label>
                <select class="form-control select2 {{ $errors->has('technician_type') ? 'is-invalid' : '' }}" name="technician_type_id" id="technician_type_id" required>
                    @foreach($technician_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('technician_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('technician_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('technician_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.technician.fields.technician_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identity_num">{{ trans('cruds.technician.fields.identity_num') }}</label>
                <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="text" name="identity_num" id="identity_num" value="{{ old('identity_num', '') }}">
                @if($errors->has('identity_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identity_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.technician.fields.identity_num_helper') }}</span>
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