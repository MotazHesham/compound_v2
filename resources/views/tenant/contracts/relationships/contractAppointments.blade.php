<div class="card">
    <div class="card-header">
        {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-contractAppointments">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.time') }}
                        </th>
                        <th>
                            {{ trans('cruds.appointment.fields.status') }}
                        </th>  
                        <th>
                            {{ trans('cruds.appointment.fields.technician') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $key => $appointment)
                        <tr data-entry-id="{{ $appointment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $appointment->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Appointment::TYPE_SELECT[$appointment->type] ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->date ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->time ? App\Models\Appointment::TIMES_SELECT[$appointment->time] : '' }}
                            </td>
                            <td>
                                {{ App\Models\Appointment::STATUS_SELECT[$appointment->status] ?? '' }}
                            </td>  
                            <td>
                                @foreach ($appointment->technicians as $key => $item)
                                    <span class="badge badge-info">{{ $item->identity_num }}</span>
                                @endforeach
                            </td>
                            <td> 
                                <a class="btn btn-xs btn-primary"
                                    href="{{ route('tenant.appointments.show', $appointment->id) }}">
                                    {{ trans('global.view') }}
                                </a>  

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
            let table = $('.datatable-contractAppointments:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
