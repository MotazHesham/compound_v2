<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTechnicianTypeRequest;
use App\Http\Requests\StoreTechnicianTypeRequest;
use App\Http\Requests\UpdateTechnicianTypeRequest;
use App\Models\TechnicianType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TechnicianTypesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('technician_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TechnicianType::query()->select(sprintf('%s.*', (new TechnicianType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'technician_type_show';
                $editGate      = 'technician_type_edit';
                $deleteGate    = 'technician_type_delete';
                $crudRoutePart = 'technician-types';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.technicianTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('technician_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.technicianTypes.create');
    }

    public function store(StoreTechnicianTypeRequest $request)
    {
        $technicianType = TechnicianType::create($request->all());

        return redirect()->route('admin.technician-types.index');
    }

    public function edit(TechnicianType $technicianType)
    {
        abort_if(Gate::denies('technician_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.technicianTypes.edit', compact('technicianType'));
    }

    public function update(UpdateTechnicianTypeRequest $request, TechnicianType $technicianType)
    {
        $technicianType->update($request->all());

        return redirect()->route('admin.technician-types.index');
    }

    public function show(TechnicianType $technicianType)
    {
        abort_if(Gate::denies('technician_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.technicianTypes.show', compact('technicianType'));
    }

    public function destroy(TechnicianType $technicianType)
    {
        abort_if(Gate::denies('technician_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicianType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTechnicianTypeRequest $request)
    {
        $technicianTypes = TechnicianType::find(request('ids'));

        foreach ($technicianTypes as $technicianType) {
            $technicianType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
