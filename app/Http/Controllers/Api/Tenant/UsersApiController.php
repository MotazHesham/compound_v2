<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\NotificationResource;
use App\Http\Resources\Tenant\TenantResource; 
use App\Traits\api_return;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersApiController extends Controller
{
    use api_return;  
    
    public function profile()
    {
        return $this->returnData(new TenantResource(Auth::user()));
    } 
    
    public function update_profile(Request $request){

        $rules = [
            'name' => 'string|required',
            'email' => 'required|email|unique:users,email,'.Auth::id(), 
            'phone' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if(!$user)  
            return $this->returnError('404',trans('global.flash.api.not_found'));

        $user->update($request->all());
        
        if($request->hasFile('photo')){  
            $user->addMedia($request->photo)->toMediaCollection('photo');
        }


        return $this->returnSuccessMessage('User Updated Successfully');
    }
    
    public function update_fcm_token(Request $request){

        $rules = [
            'fcm_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if(!$user)  
            return $this->returnError('404',trans('global.flash.api.not_found'));

        $user->update($request->all());


        return $this->returnSuccessMessage('Token Updated Successfully');
    }
    public function notifications(Request $request){
        $user = request()->user();
        $notifications = $user->userUserAlerts()->orderBy('created_at','desc')->get();
        return $this->returnData(NotificationResource::collection($notifications));
    }
}
