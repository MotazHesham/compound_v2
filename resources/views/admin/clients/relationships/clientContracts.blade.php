@can('contract_create')
    <div style="margin-bottom: 10px;" class="row p-4">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.contracts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.contract.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.contract.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-clientContracts">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contract.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.contract.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.contract.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.contract.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.contract.fields.num_of_visits') }}
                        </th>
                        <th>
                            {{ trans('cruds.contract.fields.services') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contracts as $key => $contract)
                        <tr data-entry-id="{{ $contract->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $contract->id ?? '' }}
                            </td>
                            <td>
                                {{ $contract->client->address ?? '' }}
                            </td>
                            <td>
                                {{ $contract->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $contract->end_date ?? '' }}
                            </td>
                            <td>
                                {{ $contract->num_of_visits ?? '' }}
                            </td>
                            <td>
                                {{ $contract->services ?? '' }}
                            </td>
                            <td>
                                @can('contract_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.contracts.show', $contract->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('contract_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.contracts.edit', $contract->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('contract_delete')
                                    <form action="{{ route('admin.contracts.destroy', $contract->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('contract_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contracts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-clientContracts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection