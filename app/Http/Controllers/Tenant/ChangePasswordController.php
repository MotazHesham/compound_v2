<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateProfileTenantRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function edit()
    {  
        return view('tenant.auth.passwords.edit');
    }

    public function update(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());

        return redirect()->route('tenant.profile.password.edit')->with('message', __('global.change_password_success'));
    }

    public function updateProfile(UpdateProfileTenantRequest $request)
    {
        $user = auth()->user();

        $user->update($request->validated());

        return redirect()->route('tenant.profile.password.edit')->with('message', __('global.update_profile_success'));
    } 
}
