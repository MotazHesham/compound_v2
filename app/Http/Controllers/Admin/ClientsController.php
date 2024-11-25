<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\PropertyType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Client::with(['user'])->select(sprintf('%s.*', (new Client)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_show';
                $editGate      = 'client_edit';
                $deleteGate    = 'client_delete';
                $crudRoutePart = 'clients';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.clients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $property_types = PropertyType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clients.create',compact('property_types'));
    }

    public function store(StoreClientRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'password' => bcrypt($request->password), 
            'user_type' => 'client',
            'username' => $request->username, 
            'identity_num' => $request->identity_num,
            'nationality' => $request->nationality,
        ]);
        $client = Client::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'property_type_id' => $request->property_type_id,
            'phone_2' => $request->phone_2,
            'client_status' => $request->client_status,
        ]);

        if($request->has('add_contract')){
            return redirect()->route('admin.contracts.create',['client_id' => $client->id]);
        }
        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $property_types = PropertyType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client->load('user');
        $user = $client->user;

        return view('admin.clients.edit', compact('client', 'user','property_types'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'password' => $request->password != null ? bcrypt($request->password) : $user->password,  
        ]); 
        $client->update([ 
            'address' => $request->address,
        ]);

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('user', 'clientContracts', 'clientAppointments');
        $user = $client->user;

        return view('admin.clients.show', compact('client','user'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->user()->delete();
        $client->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        $clients = Client::find(request('ids'));

        foreach ($clients as $client) {
            $client->user()->delete();
            $client->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
