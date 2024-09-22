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
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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

            $table->editColumn('user_identity_num', function ($row) {
                return $row->user ? $row->user->identity_num : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'technician_type']);

            return $table->make(true);
        }

        return view('admin.technicians.index');
    }

    public function create()
    {
        abort_if(Gate::denies('technician_create'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $technician_types = TechnicianType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.technicians.create', compact('technician_types'));
    }

    public function store(StoreTechnicianRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'password' => bcrypt($request->password), 
            'user_type' => 'technician',
            'identity_num' => $request->identity_num,
            'nationality' => $request->nationality,
            'contract_type' => $request->contract_type,
            'job_num' => $request->job_num,
            'company_name' => $request->company_name,
            'company_field' => $request->company_field,
            'commerical_num' => $request->commerical_num,
            'manager_name' => $request->manager_name,
            'manager_phone' => $request->manager_phone,
            'manager_email' => $request->manager_email,
            'company_address' => $request->company_address,
            'company_website' => $request->company_website,
            'contract_by' => $request->contract_by,
            'contract_start' => $request->contract_start,
            'contract_end' => $request->contract_end,
            'commissioner_name' => $request->commissioner_name,
            'commissioner_nationality' => $request->commissioner_nationality,
            'commissioner_id_number' => $request->commissioner_id_number,
            'commissioner_id_start' => $request->commissioner_id_start,
            'commissioner_id_end' => $request->commissioner_id_end,
            'commissioner_job' => $request->commissioner_job,
            'commissioner_phone' => $request->commissioner_phone,
            'commissioner_email' => $request->commissioner_email,
        ]);
        
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('commerical_image', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('commerical_image'))))->toMediaCollection('commerical_image');
        }

        if ($request->input('contract_image', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract_image'))))->toMediaCollection('contract_image');
        }

        if ($request->input('commissioner_id_image', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('commissioner_id_image'))))->toMediaCollection('commissioner_id_image');
        }

        if ($request->input('commissioner_image', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('commissioner_image'))))->toMediaCollection('commissioner_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        
        Technician::create([ 
            'user_id' => $user->id,
            'technician_type_id' => $request->technician_type_id, 
        ]);

        return redirect()->route('admin.technicians.index');
    }

    public function edit(Technician $technician)
    {
        abort_if(Gate::denies('technician_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $technician_types = TechnicianType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $technician->load('user', 'technician_type');
        $user = $technician->user;

        return view('admin.technicians.edit', compact('technician', 'technician_types', 'user'));
    }

    public function update(UpdateTechnicianRequest $request, Technician $technician)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'password' => $request->password != null ? bcrypt($request->password) : $user->password,  
            'identity_num' => $request->identity_num,
            'nationality' => $request->nationality,
            'contract_type' => $request->contract_type,
            'job_num' => $request->job_num,
            'company_name' => $request->company_name,
            'company_field' => $request->company_field,
            'commerical_num' => $request->commerical_num,
            'manager_name' => $request->manager_name,
            'manager_phone' => $request->manager_phone,
            'manager_email' => $request->manager_email,
            'company_address' => $request->company_address,
            'company_website' => $request->company_website,
            'contract_by' => $request->contract_by,
            'contract_start' => $request->contract_start,
            'contract_end' => $request->contract_end,
            'commissioner_name' => $request->commissioner_name,
            'commissioner_nationality' => $request->commissioner_nationality,
            'commissioner_id_number' => $request->commissioner_id_number,
            'commissioner_id_start' => $request->commissioner_id_start,
            'commissioner_id_end' => $request->commissioner_id_end,
            'commissioner_job' => $request->commissioner_job,
            'commissioner_phone' => $request->commissioner_phone,
            'commissioner_email' => $request->commissioner_email,
        ]); 
        $technician->update([
            'technician_type_id' => $request->technician_type_id, 
        ]);

        
        if ($request->input('photo', false)) {
            if (! $user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        if ($request->input('commerical_image', false)) {
            if (! $user->commerical_image || $request->input('commerical_image') !== $user->commerical_image->file_name) {
                if ($user->commerical_image) {
                    $user->commerical_image->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('commerical_image'))))->toMediaCollection('commerical_image');
            }
        } elseif ($user->commerical_image) {
            $user->commerical_image->delete();
        }

        if ($request->input('contract_image', false)) {
            if (! $user->contract_image || $request->input('contract_image') !== $user->contract_image->file_name) {
                if ($user->contract_image) {
                    $user->contract_image->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('contract_image'))))->toMediaCollection('contract_image');
            }
        } elseif ($user->contract_image) {
            $user->contract_image->delete();
        }

        if ($request->input('commissioner_id_image', false)) {
            if (! $user->commissioner_id_image || $request->input('commissioner_id_image') !== $user->commissioner_id_image->file_name) {
                if ($user->commissioner_id_image) {
                    $user->commissioner_id_image->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('commissioner_id_image'))))->toMediaCollection('commissioner_id_image');
            }
        } elseif ($user->commissioner_id_image) {
            $user->commissioner_id_image->delete();
        }

        if ($request->input('commissioner_image', false)) {
            if (! $user->commissioner_image || $request->input('commissioner_image') !== $user->commissioner_image->file_name) {
                if ($user->commissioner_image) {
                    $user->commissioner_image->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('commissioner_image'))))->toMediaCollection('commissioner_image');
            }
        } elseif ($user->commissioner_image) {
            $user->commissioner_image->delete();
        }

        return redirect()->route('admin.technicians.index');
    }

    public function show(Technician $technician)
    {
        abort_if(Gate::denies('technician_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technician->load('user', 'technician_type', 'technicianCovenants', 'technicianAppointments');
        $user = $technician->user;

        return view('admin.technicians.show', compact('technician','user'));
    }

    public function destroy(Technician $technician)
    {
        abort_if(Gate::denies('technician_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $technician->user()->delete();
        $technician->delete();

        return back();
    }

    public function massDestroy(MassDestroyTechnicianRequest $request)
    {
        $technicians = Technician::find(request('ids'));

        foreach ($technicians as $technician) {
            $technician->user()->delete();
            $technician->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
