<?php

namespace App\Http\Controllers\Api\Tenant;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; 
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon; 
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Traits\api_return;
use Validator;
use Alert;
use App\Models\Admin;
use App\Models\Tenant;

class ForgetPasswordController extends Controller
{  
    use api_return;

    public function create_token(Request $request) { 
        $rules = [
            'email' => 'required|email|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = User::where('email', $request->email)->first();

        if (!$user){ 
            return $this->returnError('404', trans('passwords.user'));
        }    

        $six_digit_random_number = random_int(100000, 999999);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => $six_digit_random_number
            ]
        );
        if ($user && $passwordReset){
            Mail::send([], [], function ($message) use ($six_digit_random_number,$request) {
                $message->to($request->email);
                $message->subject('Reset Password Notification');
                $message->setBody('Code: ' . $six_digit_random_number, 'text/html');
            });
        }

        return $this->returnData(['code' => $six_digit_random_number], trans('passwords.sent') . ' ' . $request->email);
    } 
    public function reset(Request $request) {
        
        $rules = [
            'email' => 'required|email|max:255',
            'code' => 'required|integer',
            'password' => 'required|min:6|max:20|confirmed'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $passwordReset = PasswordReset::where('email',$request->email)->first();
            
        if (!$passwordReset){ 
            return $this->returnError('401', trans('passwords.token'));
        }else{
            if($passwordReset->token != $request->code){
                return $this->returnError('401', trans('passwords.token'));
            }
        }
            
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();  
            return $this->returnError('401', trans('passwords.token'));
        } 


        $user = User::where('email', $request->email)->first();

        if (!$user){  
            return $this->returnError('401', trans('passwords.user'));
        }

        $user->password = bcrypt($request->password);
        $user->save(); 

        return $this->returnSuccessMessage(trans('passwords.updated'));
    }
}
