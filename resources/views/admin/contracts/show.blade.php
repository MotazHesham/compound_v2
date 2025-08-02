@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.contract.title') }}
            </div>
        
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.contracts.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.contract.fields.id') }}
                                </th>
                                <td>
                                    {{ $contract->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.contract.fields.client') }}
                                </th>
                                <td>
                                    {{ $contract->client->user->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.contract.fields.start_date') }}
                                </th>
                                <td>
                                    {{ $contract->start_date }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.contract.fields.end_date') }}
                                </th>
                                <td>
                                    {{ $contract->end_date }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.contract.fields.num_of_visits') }}
                                </th>
                                <td>
                                    {{ $contract->num_of_visits }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.contract.fields.services') }}
                                </th>
                                <td>
                                    {{ $contract->services }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.contract.fields.contract_file') }}
                                </th>
                                <td>
                                    <a href="{{ $contract->contract_file ? $contract->contract_file->getUrl() : '' }}" target="_blank">{{ $contract->contract_file ? $contract->contract_file->file_name : '' }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.contracts.index') }}">
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
                    <a class="nav-link active" href="#contract_appointments" role="tab" data-toggle="tab">
                        {{ trans('cruds.appointment.title') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="contract_appointments">
                    @includeIf('admin.contracts.relationships.contractAppointments', ['appointments' => $contract->contractAppointments])
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection