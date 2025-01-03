<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Tenant;
use App\Traits\api_return;
use Illuminate\Http\Request; 
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

    public function register(Request $request){

        $rules = [ 
            'name' => 'string|required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20', 
            'phone_number' => 'required|size:11|regex:/(01)[0-9]{9}/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number, 
            'user_type' => 'customer',
        ]);   
        $token = $user->createToken('user_token')->plainTextToken; 
        return $this->returnData(
            [
                'user_token' => $token,
                'user_type' => 'tenant',
                'user_id '=> $user->id, 
            ]
        );

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
