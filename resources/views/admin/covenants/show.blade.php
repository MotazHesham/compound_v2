@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.covenant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.covenants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.covenant.fields.id') }}
                        </th>
                        <td>
                            {{ $covenant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covenant.fields.technician') }}
                        </th>
                        <td>
                            {{ $covenant->technician->identity_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covenant.fields.name') }}
                        </th>
                        <td>
                            {{ $covenant->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covenant.fields.description') }}
                        </th>
                        <td>
                            {{ $covenant->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covenant.fields.price') }}
                        </th>
                        <td>
                            {{ $covenant->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covenant.fields.quantity') }}
                        </th>
                        <td>
                            {{ $covenant->quantity }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.covenants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection