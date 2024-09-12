<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCovenantRequest;
use App\Http\Requests\StoreCovenantRequest;
use App\Http\Requests\UpdateCovenantRequest;
use App\Models\Covenant;
use App\Models\Technician;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CovenantsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('covenant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Covenant::with(['technician'])->select(sprintf('%s.*', (new Covenant)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'covenant_show';
                $editGate      = 'covenant_edit';
                $deleteGate    = 'covenant_delete';
                $crudRoutePart = 'covenants';

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
            $table->addColumn('technician_identity_num', function ($row) {
                return $row->technician ? $row->technician->identity_num : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'technician']);

            return $table->make(true);
        }

        return view('admin.covenants.index');
    }

    public function create()
    {
        abort_if(Gate::denies('covenant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicians = Technician::pluck('identity_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.covenants.create', compact('technicians'));
    }

    public function store(StoreCovenantRequest $request)
    {
        $covenant = Covenant::create($request->all());

        return redirect()->route('admin.covenants.index');
    }

    public function edit(Covenant $covenant)
    {
        abort_if(Gate::denies('covenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technicians = Technician::pluck('identity_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $covenant->load('technician');

        return view('admin.covenants.edit', compact('covenant', 'technicians'));
    }

    public function update(UpdateCovenantRequest $request, Covenant $covenant)
    {
        $covenant->update($request->all());

        return redirect()->route('admin.covenants.index');
    }

    public function show(Covenant $covenant)
    {
        abort_if(Gate::denies('covenant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covenant->load('technician');

        return view('admin.covenants.show', compact('covenant'));
    }

    public function destroy(Covenant $covenant)
    {
        abort_if(Gate::denies('covenant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covenant->delete();

        return back();
    }

    public function massDestroy(MassDestroyCovenantRequest $request)
    {
        $covenants = Covenant::find(request('ids'));

        foreach ($covenants as $covenant) {
            $covenant->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
