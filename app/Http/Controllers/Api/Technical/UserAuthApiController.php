<?php

namespace App\Http\Controllers\Api\Technical;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAuthApiController extends Controller
{
    use api_return;  

    public function logout(Request $request){ 
        $request->user()->currentAccessToken()->delete();
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    } 

    public function login(Request $request){

        
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        
        $email_username = $request->email;
        $user = User::where('email', $email_username)->orWhere('username', $email_username)->first();

        if (!$user) {
            return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
        }  
        
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password]) ||
            Auth::attempt(['username' => $user->username, 'password' => $request->password])) { 
            if(Auth::user()->user_type == 'staff'){ 
                return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
            }
            $token = Auth::user()->createToken('user_token')->plainTextToken;  
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_type' => Auth::user()->user_type,
                    'user_id '=> Auth::id(), 
                ]
            ); 
        }else {
            return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
        }
    }
    
}
