<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTechnicianRequest;
use App\Http\Requests\StoreTechnicianRequest;
use App\Http\Requests\UpdateTechnicianRequest;
use App\Models\Technician;
use App\Models\TechnicianType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TechniciansController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('technician_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Technician::with(['user', 'technician_type'])->select(sprintf('%s.*', (new Technician)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'technician_show';
                $editGate      = 'technician_edit';
                $deleteGate    = 'technician_delete';
                $crudRoutePart = 'technicians';

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

            $table->addColumn('technician_type_name', function ($row) {
                return $row->technician_type ? $row->technician_type->name : '';
            });

            $table->editColumn('identity_num', function ($row) {
                return $row->identity_num ? $row->identity_num : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'technician_type']);

            return $table->make(true);
        }

        return view('admin.technicians.index');
    }

    public function create()
    {
        abort_if(Gate::denies('technician_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $technician_types = TechnicianType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.technicians.create', compact('technician_types', 'users'));
    }

    public function store(StoreTechnicianRequest $request)
    {
        $technician = Technician::create($request->all());

        return redirect()->route('admin.technicians.index');
    }

    public function edit(Technician $technician)
    {
        abort_if(Gate::denies('technician_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $technician_types = TechnicianType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $technician->load('user', 'technician_type');

        return view('admin.technicians.edit', compact('technician', 'technician_types', 'users'));
    }

    public function update(UpdateTechnicianRequest $request, Technician $technician)
    {
        $technician->update($request->all());

        return redirect()->route('admin.technicians.index');
    }

    public function show(Technician $technician)
    {
        abort_if(Gate::denies('technician_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technician->load('user', 'technician_type', 'technicianCovenants', 'technicianAppointments');

        return view('admin.technicians.show', compact('technician'));
    }

    public function destroy(Technician $technician)
    {
        abort_if(Gate::denies('technician_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technician->delete();

        return back();
    }

    public function massDestroy(MassDestroyTechnicianRequest $request)
    {
        $technicians = Technician::find(request('ids'));

        foreach ($technicians as $technician) {
            $technician->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
