@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.technician.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.technicians.update", [$technician->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="user_id" value="{{ $technician->user_id }}" id=""> 
            <div class="form-group">
                <label class="required" for="technician_type_id">{{ trans('cruds.technician.fields.technician_type') }}</label>
                <select class="form-control select2 {{ $errors->has('technician_type') ? 'is-invalid' : '' }}" name="technician_type_id" id="technician_type_id" required>
                    @foreach($technician_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('technician_type_id') ? old('technician_type_id') : $technician->technician_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('technician_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('technician_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.technician.fields.technician_type_helper') }}</span>
            </div> 
            
            @include('admin.users.partials.edit',['showRoles' => false])

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection