<?php

namespace App\Http\Controllers\Admin;

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
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContractsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contract_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Contract::with(['client'])->select(sprintf('%s.*', (new Contract)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'contract_show';
                $editGate      = 'contract_edit';
                $deleteGate    = 'contract_delete';
                $crudRoutePart = 'contracts';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('client_address', function ($row) {
                return $row->client ? $row->client->user->name : '';
            });

            $table->editColumn('num_of_visits', function ($row) {
                return $row->num_of_visits ? $row->num_of_visits : '';
            });
            $table->editColumn('services', function ($row) {
                return $row->services ? $row->services : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client']);

            return $table->make(true);
        }

        return view('admin.contracts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('contract_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::with('user')->get();
        
        $technicians = Technician::with('user')->get()->pluck('user.name', 'id');

        return view('admin.contracts.create', compact('clients','technicians'));
    }

    public function store(StoreContractRequest $request)
    {
        $contract = Contract::create($request->all());
        
        // Generate appointments
        $startDate = $request->start_date ? Carbon::parse(Carbon::createFromFormat(config('panel.date_format'), $request->start_date)->format('Y-m-d')) : null;
        $chosenDay = $request->chosen_day ; 
        $appointments = [];

        // Start from the month after the contract's start_date if the chosen day has passed
        $currentMonth = $startDate->copy();
        if ($startDate->day > $chosenDay) {
            $currentMonth->addMonth();
        }

        for ($i = 0; $i < $request->num_of_visits; $i++) {

            $appointmentDate = $currentMonth->copy()->day($chosenDay);
            
            // Handle edge cases where the chosen day might not exist in the month
            if ($appointmentDate->month != $currentMonth->month) {
                $appointmentDate = $appointmentDate->subDay();
            } 

            $appointments[] = [
                'contract_id' => $contract->id,
                'client_id' => $request->client_id,
                'time' => $request->time,
                'date' => $appointmentDate->toDateString(),  
                'status' => 'pending',
            ];

            // Move to the next month
            $currentMonth->addMonth();
        }
    
        // Bulk insert appointments
        Appointment::insert($appointments);

        foreach(Appointment::where('contract_id',$contract->id)->get() as $appointment){ 
            $appointment->technicians()->sync($request->input('technicians', []));
        }

        return redirect()->route('admin.contracts.index');
    }

    public function edit(Contract $contract)
    {
        abort_if(Gate::denies('contract_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contract->load('client');

        return view('admin.contracts.edit', compact('clients', 'contract'));
    }

    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->update($request->all());

        return redirect()->route('admin.contracts.index');
    }

    public function show(Contract $contract)
    {
        abort_if(Gate::denies('contract_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->load('client', 'contractAppointments');

        return view('admin.contracts.show', compact('contract'));
    }

    public function destroy(Contract $contract)
    {
        abort_if(Gate::denies('contract_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contract->delete();

        return back();
    }

    public function massDestroy(MassDestroyContractRequest $request)
    {
        $contracts = Contract::find(request('ids'));

        foreach ($contracts as $contract) {
            $contract->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
