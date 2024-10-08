<?php

namespace App\Http\Controllers\Api\Technical;

use App\Http\Controllers\Controller; 
use App\Http\Resources\Technical\UserResource; 
use App\Traits\api_return;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersApiController extends Controller
{
    use api_return;  
    
    public function profile()
    {
        return $this->returnData(new UserResource(Auth::user()));
    } 
    
    public function update_profile(Request $request){

        $rules = [
            'name' => 'string|required',
            'email' => 'required|email|unique:users,email,'.Auth::id(), 
            'phone' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if(!$user)  
            return $this->returnError('404',trans('global.flash.api.not_found'));

        $user->update($request->all());


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
}
