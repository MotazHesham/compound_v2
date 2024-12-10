@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <td>
                                {{ $user->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.phone') }}
                            </th>
                            <td>
                                {{ $user->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <td>
                                @foreach ($user->roles as $key => $roles)
                                    <span class="label label-info">{{ $roles->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.email_verified_at') }}
                            </th>
                            <td>
                                {{ $user->email_verified_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.photo') }}
                            </th>
                            <td>
                                @if ($user->photo)
                                    <a href="{{ $user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $user->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.identity_num') }}
                            </th>
                            <td>
                                {{ $user->identity_num }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.nationality') }}
                            </th>
                            <td>
                                {{ App\Models\User::NATIONALITY_SELECT[$user->nationality] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.contract_type') }}
                            </th>
                            <td>
                                {{ App\Models\User::CONTRACT_TYPE_SELECT[$user->contract_type] ?? '' }}
                            </td>
                        </tr>
                        @if($user->contract_type == 'on_bail')
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.job_num') }}
                            </th>
                            <td>
                                {{ $user->job_num }}
                            </td>
                        </tr>
                        @else
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.company_name') }}
                            </th>
                            <td>
                                {{ $user->company_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.company_field') }}
                            </th>
                            <td>
                                {{ $user->company_field }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commerical_num') }}
                            </th>
                            <td>
                                {{ $user->commerical_num }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commerical_image') }}
                            </th>
                            <td>
                                @if ($user->commerical_image)
                                    <a href="{{ $user->commerical_image->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.manager_name') }}
                            </th>
                            <td>
                                {{ $user->manager_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.manager_phone') }}
                            </th>
                            <td>
                                {{ $user->manager_phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.manager_email') }}
                            </th>
                            <td>
                                {{ $user->manager_email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.company_address') }}
                            </th>
                            <td>
                                {{ $user->company_address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.company_website') }}
                            </th>
                            <td>
                                {{ $user->company_website }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.contract_by') }}
                            </th>
                            <td>
                                {{ App\Models\User::CONTRACT_BY_SELECT[$user->contract_by] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.contract_image') }}
                            </th>
                            <td>
                                @if ($user->contract_image)
                                    <a href="{{ $user->contract_image->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.contract_start') }}
                            </th>
                            <td>
                                {{ $user->contract_start }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.contract_end') }}
                            </th>
                            <td>
                                {{ $user->contract_end }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_name') }}
                            </th>
                            <td>
                                {{ $user->commissioner_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_nationality') }}
                            </th>
                            <td>
                                {{ App\Models\User::NATIONALITY_SELECT[$user->commissioner_nationality] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_id_number') }}
                            </th>
                            <td>
                                {{ $user->commissioner_id_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_id_image') }}
                            </th>
                            <td>
                                @if ($user->commissioner_id_image)
                                    <a href="{{ $user->commissioner_id_image->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_id_start') }}
                            </th>
                            <td>
                                {{ $user->commissioner_id_start }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_id_end') }}
                            </th>
                            <td>
                                {{ $user->commissioner_id_end }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_job') }}
                            </th>
                            <td>
                                {{ $user->commissioner_job }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_image') }}
                            </th>
                            <td>
                                @if ($user->commissioner_image)
                                    <a href="{{ $user->commissioner_image->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_phone') }}
                            </th>
                            <td>
                                {{ $user->commissioner_phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.commissioner_email') }}
                            </th>
                            <td>
                                {{ $user->commissioner_email }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
                <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="user_user_alerts">
                @includeIf('admin.users.relationships.userUserAlerts', [
                    'userAlerts' => $user->userUserAlerts,
                ])
            </div>
        </div>
    </div>
@endsection
