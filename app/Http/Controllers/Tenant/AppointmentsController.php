<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Covenant;
use App\Models\Technician;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{ 
    public function index(Request $request)
    { 
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        if ($request->ajax()) {
            $query = Appointment::with(['contract', 'client.user', 'technicians.user'])->where('client_id',$client->id)->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) { 
                $crudRoutePart = 'appointments';

                return view('partials.tenant_datatablesActions', compact( 
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Appointment::TYPE_SELECT[$row->type] : '';
            });

            $table->editColumn('time', function ($row) {
                return $row->time ? Appointment::TIMES_SELECT[$row->time] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Appointment::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('problem_description', function ($row) {
                return $row->problem_description ? $row->problem_description : '';
            });
            $table->editColumn('problem_photos', function ($row) {
                if (! $row->problem_photos) {
                    return '';
                }
                $links = [];
                foreach ($row->problem_photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('cancel_reason', function ($row) {
                return $row->cancel_reason ? $row->cancel_reason : '';
            });
            $table->addColumn('contract_id', function ($row) {
                return $row->contract ? '<a href="'.route('tenant.contracts.show',$row->contract_id).'">'.$row->contract_id.'</a>' : '';
            }); 

            $table->editColumn('technician', function ($row) {
                $labels = [];
                foreach ($row->technicians as $technician) {
                    if($technician->user){
                        $labels[] = sprintf('<span class="badge badge-info badge-many">%s</span>', $technician->user->name);
                    }
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'problem_photos', 'contract_id' , 'technician']);

            return $table->make(true);
        }

        return view('tenant.appointments.index');
    }


    public function show(Appointment $appointment)
    { 

        $appointment->load('contract', 'client.user', 'technicians', 'appointmentAppointmentCovenants');
        $covenants = Covenant::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.appointments.show', compact('appointment','covenants'));
    } 
}
