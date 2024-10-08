<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles'])->where('user_type','staff')->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'users';

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
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="badge badge-info badge-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'roles']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
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

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
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

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        $users = User::find(request('ids'));

        foreach ($users as $user) {
            $user->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}