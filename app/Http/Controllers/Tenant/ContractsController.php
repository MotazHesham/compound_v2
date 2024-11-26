<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContractRequest;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Technician;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{
    public function index(Request $request)
    { 
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        if ($request->ajax()) {
            $query = Contract::with(['client'])->where('client_id',$client->id)->select(sprintf('%s.*', (new Contract)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) { 
                $crudRoutePart = 'contracts';

                return view('partials.tenant_datatablesActions', compact( 
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('num_of_visits', function ($row) {
                return $row->num_of_visits ? $row->num_of_visits : '';
            });
            $table->editColumn('services', function ($row) {
                return $row->services ? $row->services : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('tenant.contracts.index');
    }

    public function show(Contract $contract)
    { 

        $contract->load('client', 'contractAppointments');

        return view('tenant.contracts.show', compact('contract'));
    } 
}
