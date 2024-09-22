
<div class="row">
    
    <div class="form-group col-md-4">
        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
            id="name" value="{{ old('name', '') }}" required>
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
            name="email" id="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label for="phone">{{ trans('cruds.user.fields.phone') }}</label>
        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
            name="phone" id="phone" value="{{ old('phone', '') }}">
        @if ($errors->has('phone'))
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
    </div>
    @if($showRoles)
        <div class="form-group col-md-4">
            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
            <div style="padding-bottom: 4px">
                <span class="btn btn-info btn-xs select-all"
                    style="border-radius: 0">{{ trans('global.select_all') }}</span>
                <span class="btn btn-info btn-xs deselect-all"
                    style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
            </div>
            <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]"
                id="roles" multiple required>
                @foreach ($roles as $id => $role)
                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                        {{ $role }}</option>
                @endforeach
            </select>
            @if ($errors->has('roles'))
                <div class="invalid-feedback">
                    {{ $errors->first('roles') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
        </div>
    @endif
    <div class="form-group @if($showRoles) col-md-4 @else col-md-6 @endif">
        <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
            name="password" id="password" required>
        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
    </div>
    <div class="form-group @if($showRoles) col-md-4 @else col-md-6 @endif">
        <label for="photo">{{ trans('cruds.user.fields.photo') }}</label>
        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
        </div>
        @if ($errors->has('photo'))
            <div class="invalid-feedback">
                {{ $errors->first('photo') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label for="identity_num">{{ trans('cruds.user.fields.identity_num') }}</label>
        <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="text"
            name="identity_num" id="identity_num" value="{{ old('identity_num', '') }}">
        @if ($errors->has('identity_num'))
            <div class="invalid-feedback">
                {{ $errors->first('identity_num') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.user.fields.identity_num_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label>{{ trans('cruds.user.fields.nationality') }}</label>
        <select class="form-control select2 {{ $errors->has('nationality') ? 'is-invalid' : '' }}" name="nationality"
            id="nationality">
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
    <div class="form-group col-md-4">
        <label class="required">{{ trans('cruds.user.fields.contract_type') }}</label>
        <select class="form-control {{ $errors->has('contract_type') ? 'is-invalid' : '' }}"
            name="contract_type" id="contract_type" required>
            <option value disabled {{ old('contract_type', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\User::CONTRACT_TYPE_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('contract_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('contract_type'))
            <div class="invalid-feedback">
                {{ $errors->first('contract_type') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.user.fields.contract_type_helper') }}</span>
    </div>
    <div class="col-md-12" id="on_bail" style="display: none"> 
        <div class="form-group">
            <label for="job_num">{{ trans('cruds.user.fields.job_num') }}</label>
            <input class="form-control {{ $errors->has('job_num') ? 'is-invalid' : '' }}" type="text"
                name="job_num" id="job_num" value="{{ old('job_num', '') }}">
            @if ($errors->has('job_num'))
                <div class="invalid-feedback">
                    {{ $errors->first('job_num') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.job_num_helper') }}</span>
        </div>
    </div>
    <div class="col-md-12" id="subcontractor" style="display: none">
        <div class="row"> 
            <div class="form-group col-md-4">
                <label for="company_name">{{ trans('cruds.user.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text"
                    name="company_name" id="company_name" value="{{ old('company_name', '') }}">
                @if ($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="company_field">{{ trans('cruds.user.fields.company_field') }}</label>
                <input class="form-control {{ $errors->has('company_field') ? 'is-invalid' : '' }}" type="text"
                    name="company_field" id="company_field" value="{{ old('company_field', '') }}">
                @if ($errors->has('company_field'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_field') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.company_field_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commerical_num">{{ trans('cruds.user.fields.commerical_num') }}</label>
                <input class="form-control {{ $errors->has('commerical_num') ? 'is-invalid' : '' }}" type="text"
                    name="commerical_num" id="commerical_num" value="{{ old('commerical_num', '') }}">
                @if ($errors->has('commerical_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commerical_num_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commerical_image">{{ trans('cruds.user.fields.commerical_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('commerical_image') ? 'is-invalid' : '' }}"
                    id="commerical_image-dropzone">
                </div>
                @if ($errors->has('commerical_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commerical_image_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="manager_name">{{ trans('cruds.user.fields.manager_name') }}</label>
                <input class="form-control {{ $errors->has('manager_name') ? 'is-invalid' : '' }}" type="text"
                    name="manager_name" id="manager_name" value="{{ old('manager_name', '') }}">
                @if ($errors->has('manager_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manager_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.manager_name_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="manager_phone">{{ trans('cruds.user.fields.manager_phone') }}</label>
                <input class="form-control {{ $errors->has('manager_phone') ? 'is-invalid' : '' }}" type="text"
                    name="manager_phone" id="manager_phone" value="{{ old('manager_phone', '') }}">
                @if ($errors->has('manager_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manager_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.manager_phone_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="manager_email">{{ trans('cruds.user.fields.manager_email') }}</label>
                <input class="form-control {{ $errors->has('manager_email') ? 'is-invalid' : '' }}" type="email"
                    name="manager_email" id="manager_email" value="{{ old('manager_email') }}">
                @if ($errors->has('manager_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('manager_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.manager_email_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="company_address">{{ trans('cruds.user.fields.company_address') }}</label>
                <input class="form-control {{ $errors->has('company_address') ? 'is-invalid' : '' }}" type="text"
                    name="company_address" id="company_address" value="{{ old('company_address', '') }}">
                @if ($errors->has('company_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.company_address_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="company_website">{{ trans('cruds.user.fields.company_website') }}</label>
                <input class="form-control {{ $errors->has('company_website') ? 'is-invalid' : '' }}" type="text"
                    name="company_website" id="company_website" value="{{ old('company_website', '') }}">
                @if ($errors->has('company_website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_website') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.company_website_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="">{{ trans('cruds.user.fields.contract_by') }}</label>
                <select class="form-control {{ $errors->has('contract_by') ? 'is-invalid' : '' }}"
                    name="contract_by" id="contract_by" >
                    <option value disabled {{ old('contract_by', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach (App\Models\User::CONTRACT_BY_SELECT as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('contract_by', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('contract_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contract_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.contract_by_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="contract_image">{{ trans('cruds.user.fields.contract_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('contract_image') ? 'is-invalid' : '' }}"
                    id="contract_image-dropzone">
                </div>
                @if ($errors->has('contract_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contract_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.contract_image_helper') }}</span>
            </div>
            <div class="col-md-12" style="display: none" id="contact_dates">
                <div class="row">
                    <div class="forlasm-group col-md-6">
                        <label for="contract_start">{{ trans('cruds.user.fields.contract_start') }}</label>
                        <input class="form-control date {{ $errors->has('contract_start') ? 'is-invalid' : '' }}"
                            type="text" name="contract_start" id="contract_start" value="{{ old('contract_start') }}">
                        @if ($errors->has('contract_start'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contract_start') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.contract_start_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contract_end">{{ trans('cruds.user.fields.contract_end') }}</label>
                        <input class="form-control date {{ $errors->has('contract_end') ? 'is-invalid' : '' }}"
                            type="text" name="contract_end" id="contract_end" value="{{ old('contract_end') }}">
                        @if ($errors->has('contract_end'))
                            <div cs="invalid-feedback">
                                {{ $errors->first('contract_end') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.contract_end_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                بيانات المفوض
                <hr>
            </div> 
            <div class="col-md-8 mb-4">
            </div> 
            <div class="form-group col-md-4">
                <label for="commissioner_name">{{ trans('cruds.user.fields.commissioner_name') }}</label>
                <input class="form-control {{ $errors->has('commissioner_name') ? 'is-invalid' : '' }}"
                    type="text" name="commissioner_name" id="commissioner_name"
                    value="{{ old('commissioner_name', '') }}">
                @if ($errors->has('commissioner_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_name_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label>{{ trans('cruds.user.fields.commissioner_nationality') }}</label>
                <select class="form-control select2 {{ $errors->has('commissioner_nationality') ? 'is-invalid' : '' }}"
                    name="commissioner_nationality" id="commissioner_nationality">
                    <option value disabled {{ old('commissioner_nationality', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach (App\Models\User::NATIONALITY_SELECT as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('commissioner_nationality', '') === (string) $key ? 'selected' : '' }}>
                            {{ $label }}</option>
                    @endforeach
                </select>
                @if ($errors->has('commissioner_nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_nationality_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_id_number">{{ trans('cruds.user.fields.commissioner_id_number') }}</label>
                <input class="form-control {{ $errors->has('commissioner_id_number') ? 'is-invalid' : '' }}"
                    type="text" name="commissioner_id_number" id="commissioner_id_number"
                    value="{{ old('commissioner_id_number', '') }}">
                @if ($errors->has('commissioner_id_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_id_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_id_number_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_id_image">{{ trans('cruds.user.fields.commissioner_id_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('commissioner_id_image') ? 'is-invalid' : '' }}"
                    id="commissioner_id_image-dropzone">
                </div>
                @if ($errors->has('commissioner_id_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_id_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_id_image_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_id_start">{{ trans('cruds.user.fields.commissioner_id_start') }}</label>
                <input class="form-control date {{ $errors->has('commissioner_id_start') ? 'is-invalid' : '' }}"
                    type="text" name="commissioner_id_start" id="commissioner_id_start"
                    value="{{ old('commissioner_id_start') }}">
                @if ($errors->has('commissioner_id_start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_id_start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_id_start_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_id_end">{{ trans('cruds.user.fields.commissioner_id_end') }}</label>
                <input class="form-control date {{ $errors->has('commissioner_id_end') ? 'is-invalid' : '' }}"
                    type="text" name="commissioner_id_end" id="commissioner_id_end"
                    value="{{ old('commissioner_id_end') }}">
                @if ($errors->has('commissioner_id_end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_id_end') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_id_end_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_job">{{ trans('cruds.user.fields.commissioner_job') }}</label>
                <input class="form-control {{ $errors->has('commissioner_job') ? 'is-invalid' : '' }}"
                    type="text" name="commissioner_job" id="commissioner_job"
                    value="{{ old('commissioner_job', '') }}">
                @if ($errors->has('commissioner_job'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_job') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_job_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_image">{{ trans('cruds.user.fields.commissioner_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('commissioner_image') ? 'is-invalid' : '' }}"
                    id="commissioner_image-dropzone">
                </div>
                @if ($errors->has('commissioner_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_image_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_phone">{{ trans('cruds.user.fields.commissioner_phone') }}</label>
                <input class="form-control {{ $errors->has('commissioner_phone') ? 'is-invalid' : '' }}"
                    type="text" name="commissioner_phone" id="commissioner_phone"
                    value="{{ old('commissioner_phone', '') }}">
                @if ($errors->has('commissioner_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_phone_helper') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="commissioner_email">{{ trans('cruds.user.fields.commissioner_email') }}</label>
                <input class="form-control {{ $errors->has('commissioner_email') ? 'is-invalid' : '' }}"
                    type="email" name="commissioner_email" id="commissioner_email"
                    value="{{ old('commissioner_email') }}">
                @if ($errors->has('commissioner_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commissioner_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.commissioner_email_helper') }}</span>
            </div>
        </div>
    </div>
</div> 

@section('scripts')
    <script>
        $('#contract_type').on('change',function(){
            if(this.value == 'on_bail'){
                $('#on_bail').css('display','block');
                $('#subcontractor').css('display','none');
            }else if(this.value == 'subcontractor'){
                $('#on_bail').css('display','none');
                $('#subcontractor').css('display','block');
            }
        });
    
        $('#contract_by').on('change',function(){
            if(this.value == 'external'){
                $('#contact_dates').css('display','block'); 
            }else if(this.value == 'ajir'){
                $('#contact_dates').css('display','none'); 
            }
        });

        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($user) && $user->photo)
                    var file = {!! json_encode($user->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.commericalImageDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 4, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                $('form').find('input[name="commerical_image"]').remove()
                $('form').append('<input type="hidden" name="commerical_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="commerical_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($user) && $user->commerical_image)
                    var file = {!! json_encode($user->commerical_image) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="commerical_image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.contractImageDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 4, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                $('form').find('input[name="contract_image"]').remove()
                $('form').append('<input type="hidden" name="contract_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="contract_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($user) && $user->contract_image)
                    var file = {!! json_encode($user->contract_image) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="contract_image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.commissionerIdImageDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 4, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                $('form').find('input[name="commissioner_id_image"]').remove()
                $('form').append('<input type="hidden" name="commissioner_id_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="commissioner_id_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($user) && $user->commissioner_id_image)
                    var file = {!! json_encode($user->commissioner_id_image) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="commissioner_id_image" value="' + file.file_name +
                        '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.commissionerImageDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 4, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 4
            },
            success: function(file, response) {
                $('form').find('input[name="commissioner_image"]').remove()
                $('form').append('<input type="hidden" name="commissioner_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="commissioner_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($user) && $user->commissioner_image)
                    var file = {!! json_encode($user->commissioner_image) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="commissioner_image" value="' + file.file_name +
                        '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
