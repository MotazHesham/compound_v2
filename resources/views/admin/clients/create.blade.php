@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="username" class="required">{{ trans('cruds.user.fields.username') }}</label>
                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text"
                            name="username" id="username" value="{{ old('username', '') }}" required>
                        @if ($errors->has('username'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
                    </div>
                </div> 
                <div class="form-group col-md-3">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="text" name="password" id="password" required>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="phone" class="required">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div> 
                <div class="form-group col-md-3">
                    <label for="phone_2">{{ trans('cruds.client.fields.phone_2') }}</label>
                    <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', '') }}">
                    @if($errors->has('phone_2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_2') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.phone_2_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="property_type_id">{{ trans('cruds.client.fields.property_type') }}</label>
                    <select class="form-control select2 {{ $errors->has('property_type') ? 'is-invalid' : '' }}" name="property_type_id" id="property_type_id" required>
                        @foreach($property_types as $id => $entry)
                            <option value="{{ $id }}" {{ old('property_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('property_type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('property_type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.property_type_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">{{ trans('cruds.client.fields.client_status') }}</label>
                    <select class="form-control {{ $errors->has('client_status') ? 'is-invalid' : '' }}" name="client_status" id="client_status" required>
                        <option value disabled {{ old('client_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Client::CLIENT_STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('client_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('client_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('client_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.client_status_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">{{ trans('cruds.user.fields.nationality') }}</label>
                    <select class="form-control select2 {{ $errors->has('nationality') ? 'is-invalid' : '' }}"
                        name="nationality" id="nationality" required>
                        <option value disabled {{ old('nationality', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\User::NATIONALITY_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('nationality', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('nationality'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nationality') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.nationality_helper') }}</span>
                </div> 
                <div class="form-group col-md-3">
                    <label for="identity_num" class="required">{{ trans('cruds.user.fields.identity_num') }}</label>
                    <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="text"
                        name="identity_num" id="identity_num" value="{{ old('identity_num', '') }}" required>
                    @if ($errors->has('identity_num'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identity_num') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.identity_num_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="address">{{ trans('cruds.client.fields.address') }}</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.address_helper') }}</span>
                </div>
            </div>
            <div class="d-flex" style="justify-content: space-around;">
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
                <div class="form-group">
                    <button class="btn btn-dark" type="submit" name="add_contract">
                        {{ trans('cruds.client.save_and_add_contract') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection