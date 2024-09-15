@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appointment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.appointments.update", [$appointment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row"> 
                <div class="form-group col-md-6">
                    <label class="required" for="contract_id">{{ trans('cruds.appointment.fields.contract') }}</label>
                    <select class="form-control select2 {{ $errors->has('contract') ? 'is-invalid' : '' }}" name="contract_id" id="contract_id" required>
                        @foreach($contracts as $id => $entry)
                            <option value="{{ $id }}" {{ (old('contract_id') ? old('contract_id') : $appointment->contract->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('contract'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contract') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.contract_helper') }}</span>
                </div> 
                <div class="form-group col-md-6">
                    <label>{{ trans('cruds.appointment.fields.type') }}</label>
                    <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                        <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Appointment::TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('type', $appointment->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.type_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                    <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $appointment->date) }}" required>
                    @if($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="time">{{ trans('cruds.appointment.fields.time') }}</label>
                    <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time', $appointment->time) }}" required>
                    @if($errors->has('time'))
                        <div class="invalid-feedback">
                            {{ $errors->first('time') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.time_helper') }}</span>
                </div>  
                <div class="form-group col-md-4">
                    <label for="technicians">{{ trans('cruds.appointment.fields.technician') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('technicians') ? 'is-invalid' : '' }}" name="technicians[]" id="technicians" multiple>
                        @foreach($technicians as $id => $technician)
                            <option value="{{ $id }}" {{ (in_array($id, old('technicians', [])) || $appointment->technicians->contains($id)) ? 'selected' : '' }}>{{ $technician }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('technicians'))
                        <div class="invalid-feedback">
                            {{ $errors->first('technicians') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.technician_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="problem_description">{{ trans('cruds.appointment.fields.problem_description') }}</label>
                    <textarea class="form-control {{ $errors->has('problem_description') ? 'is-invalid' : '' }}" name="problem_description" id="problem_description">{{ old('problem_description', $appointment->problem_description) }}</textarea>
                    @if($errors->has('problem_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('problem_description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.problem_description_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="problem_photos">{{ trans('cruds.appointment.fields.problem_photos') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('problem_photos') ? 'is-invalid' : '' }}" id="problem_photos-dropzone">
                    </div>
                    @if($errors->has('problem_photos'))
                        <div class="invalid-feedback">
                            {{ $errors->first('problem_photos') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointment.fields.problem_photos_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedProblemPhotosMap = {}
Dropzone.options.problemPhotosDropzone = {
    url: '{{ route('admin.appointments.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="problem_photos[]" value="' + response.name + '">')
      uploadedProblemPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedProblemPhotosMap[file.name]
      }
      $('form').find('input[name="problem_photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($appointment) && $appointment->problem_photos)
      var files = {!! json_encode($appointment->problem_photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="problem_photos[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
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