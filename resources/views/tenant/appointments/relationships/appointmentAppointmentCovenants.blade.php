

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
