@can('covenant_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.covenants.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.covenant.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.covenant.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-technicianCovenants">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.covenant.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.covenant.fields.technician') }}
                        </th>
                        <th>
                            {{ trans('cruds.covenant.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.covenant.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.covenant.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.covenant.fields.quantity') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($covenants as $key => $covenant)
                        <tr data-entry-id="{{ $covenant->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $covenant->id ?? '' }}
                            </td>
                            <td>
                                {{ $covenant->technician->identity_num ?? '' }}
                            </td>
                            <td>
                                {{ $covenant->name ?? '' }}
                            </td>
                            <td>
                                {{ $covenant->description ?? '' }}
                            </td>
                            <td>
                                {{ $covenant->price ?? '' }}
                            </td>
                            <td>
                                {{ $covenant->quantity ?? '' }}
                            </td>
                            <td>
                                @can('covenant_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.covenants.show', $covenant->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('covenant_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.covenants.edit', $covenant->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('covenant_delete')
                                    <form action="{{ route('admin.covenants.destroy', $covenant->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('covenant_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.covenants.massDestroy') }}",
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
  let table = $('.datatable-technicianCovenants:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection