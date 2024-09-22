@can('appointment_covenant_create')
    <form method="POST" action="{{ route('admin.appointment-covenants.store') }}" class="p-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="covenant_id">{{ trans('cruds.appointmentCovenant.fields.covenant') }}</label>
                    <select class="form-control select2 {{ $errors->has('covenant') ? 'is-invalid' : '' }}" name="covenant_id"
                        id="covenant_id">
                        @foreach ($covenants as $id => $entry)
                            <option value="{{ $id }}" {{ old('covenant_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('covenant'))
                        <div class="invalid-feedback">
                            {{ $errors->first('covenant') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointmentCovenant.fields.covenant_helper') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="quantity">{{ trans('cruds.appointmentCovenant.fields.quantity') }}</label>
                    <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity"
                        id="quantity" value="{{ old('quantity', '') }}" step="1">
                    @if ($errors->has('quantity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.appointmentCovenant.fields.quantity_helper') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </form>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.appointmentCovenant.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table
                class=" table table-bordered table-striped table-hover datatable datatable-appointmentAppointmentCovenants">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.appointmentCovenant.fields.id') }}
                        </th> 
                        <th>
                            {{ trans('cruds.appointmentCovenant.fields.covenant') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointmentCovenant.fields.quantity') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointmentCovenants as $key => $appointmentCovenant)
                        <tr data-entry-id="{{ $appointmentCovenant->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $appointmentCovenant->id ?? '' }}
                            </td> 
                            <td>
                                {{ $appointmentCovenant->covenant->name ?? '' }}
                            </td>
                            <td>
                                {{ $appointmentCovenant->quantity ?? '' }}
                            </td>
                            <td>
                                @can('appointment_covenant_show')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.appointment-covenants.show', $appointmentCovenant->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('appointment_covenant_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.appointment-covenants.edit', $appointmentCovenant->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('appointment_covenant_delete')
                                    <form
                                        action="{{ route('admin.appointment-covenants.destroy', $appointmentCovenant->id) }}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('appointment_covenant_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.appointment-covenants.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-appointmentAppointmentCovenants:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
