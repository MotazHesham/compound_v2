@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.client.title') }}
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.client.fields.id') }}
                                </th>
                                <td>
                                    {{ $client->id }}
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
                                    {{ trans('cruds.client.fields.address') }}
                                </th>
                                <td>
                                    {{ $client->address }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.client.fields.phone_2') }}
                                </th>
                                <td>
                                    {{ $client->phone_2 }}
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
                                    {{ trans('cruds.client.fields.client_status') }}
                                </th>
                                <td>
                                    {{ App\Models\Client::CLIENT_STATUS_SELECT[$client->client_status] ?? '' }}
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
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#client_contracts" role="tab" data-toggle="tab">
                        {{ trans('cruds.contract.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#client_appointments" role="tab" data-toggle="tab">
                        {{ trans('cruds.appointment.title') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="client_contracts">
                    @includeIf('admin.clients.relationships.clientContracts', ['contracts' => $client->clientContracts])
                </div>
                <div class="tab-pane" role="tabpanel" id="client_appointments">
                    @includeIf('admin.clients.relationships.clientAppointments', ['appointments' => $client->clientAppointments])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection