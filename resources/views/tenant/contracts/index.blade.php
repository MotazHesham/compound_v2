@extends('layouts.tenant')
@section('content') 
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.contract.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Contract">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contract.fields.id') }}
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
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('tenant.contracts.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    }, 
                    {
                        data: 'end_date',
                        name: 'end_date'
                    }, 
                    {
                        data: 'num_of_visits',
                        name: 'num_of_visits'
                    },
                    {
                        data: 'services',
                        name: 'services'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            };
            let table = $('.datatable-Contract').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
