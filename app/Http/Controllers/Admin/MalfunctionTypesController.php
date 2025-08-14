<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMalfunctionTypeRequest;
use App\Http\Requests\StoreMalfunctionTypeRequest;
use App\Http\Requests\UpdateMalfunctionTypeRequest;
use App\Models\MalfunctionType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MalfunctionTypesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('malfunction_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MalfunctionType::query()->select(sprintf('%s.*', (new MalfunctionType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'malfunction_type_show';
                $editGate      = 'malfunction_type_edit';
                $deleteGate    = 'malfunction_type_delete';
                $crudRoutePart = 'malfunction-types';

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

        return view('admin.malfunctionTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('malfunction_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.malfunctionTypes.create');
    }

    public function store(StoreMalfunctionTypeRequest $request)
    {
        $malfunctionType = MalfunctionType::create($request->all());

        return redirect()->route('admin.malfunction-types.index');
    }

    public function edit(MalfunctionType $malfunctionType)
    {
        abort_if(Gate::denies('malfunction_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.malfunctionTypes.edit', compact('malfunctionType'));
    }

    public function update(UpdateMalfunctionTypeRequest $request, MalfunctionType $malfunctionType)
    {
        $malfunctionType->update($request->all());

        return redirect()->route('admin.malfunction-types.index');
    }

    public function show(MalfunctionType $malfunctionType)
    {
        abort_if(Gate::denies('malfunction_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.malfunctionTypes.show', compact('malfunctionType'));
    }

    public function destroy(MalfunctionType $malfunctionType)
    {
        abort_if(Gate::denies('malfunction_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $malfunctionType->delete();

        return back();
    }

    public function massDestroy(MassDestroyMalfunctionTypeRequest $request)
    {
        $malfunctionTypes = MalfunctionType::find(request('ids'));

        foreach ($malfunctionTypes as $malfunctionType) {
            $malfunctionType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
