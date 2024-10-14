<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\AppointmentResource;
use App\Http\Resources\Tenant\OrderResource;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\exchangeOrder;
use App\Models\order;
use App\Models\Rate;
use App\Models\TechnicalRate;
use App\Models\User;
use App\Models\UserAlert;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AppointmentsApiController extends Controller
{
    use api_return;    

    public function get_token(Request $request){
        
        $rules = [    
            'appointment_id' => 'required|integer',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 

        $appointment = Appointment::findOrFail($request->appointment_id);
        if(!$appointment->finish_code){
            $appointment->finish_code = random_int(100000, 999999); 
            $appointment->save(); 
        }
        
        return $this->returnData(['code' => $appointment->finish_code]);
    }

    public function upcoming(){  
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        $appointments = Appointment::whereIn('status',['pending','working'])->where('client_id',$client->id)->orderBy('updated_at','desc')->paginate(15);
        $resource = AppointmentResource::collection($appointments);  
        return $this->returnPaginationData($resource,$appointments,'success'); 
    } 

    public function completed(){  
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        $appointments = Appointment::where('status','completed')->where('client_id',$client->id)->orderBy('updated_at','desc')->paginate(15);
        $resource = AppointmentResource::collection($appointments);  
        return $this->returnPaginationData($resource,$appointments,'success'); 
    } 
    
    public function closed(){  
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        $appointments = Appointment::where('status','canceled')->where('client_id',$client->id)->orderBy('updated_at','desc')->paginate(15);
        $resource = AppointmentResource::collection($appointments);  
        return $this->returnPaginationData($resource,$appointments,'success'); 
    } 

    public function available_times(Request $request){
        
        $rules = [    
            'date' => 'required|date_format:Y-m-d',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  
        $times = [];
        foreach(Appointment::TIMES_SELECT as $key => $entry){
            $tmp = [];
            $tmp['text'] = $entry;
            $tmp['time'] = $key;
            $tmp['available'] = true; 
            $times[] = $tmp;
        }
        return $this->returnData($times);
    }

    public function rate(Request $request){
        
        $rules = [     
            'appointment_id' => 'integer|required',
            'review' => 'string|required',
            'rate' => 'in:1,2,3,4,5|required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 

        $appointment = Appointment::find($request->appointment_id);
        if(!$appointment){
            return $this->returnError('401','not found');
        } 

        $appointment->review = $request->review;
        $appointment->rate = $request->rate;  
        $appointment->save();

        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    public function add(Request $request){
        
        $rules = [    
            'problem_description'=> 'string|required',
            'date' => 'required|date_format:' . config('panel.date_format'),
            'time' => 'required|in:'. implode(',',array_keys(Appointment::TIMES_SELECT)), 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  

        $client = Client::where('user_id',Auth::id())->firstOrFail();

        $appointment = Appointment::create([ 
            'type' => 'emergency',
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
            'problem_description' => $request->problem_description,
            'client_id' => $client->id,
        ]); 

        $userAlert = UserAlert::create([
            'alert_text' => 'طلب معاد من ' . auth()->user()->name,
            'alert_link' => route('admin.appointments.show',$appointment->id),
            'type' => 'system',
        ]);
        
        $userAlert->users()->sync(User::where('user_type','staff')->get()->pluck('id'));

        if($request->has('images')){ 
            foreach ($request->images as $key => $image) { 
                $appointment->addMedia($image)->toMediaCollection('problem_photos');
            }
        }   
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    } 
    
    
    public function cancel($id){  

        $appointment = Appointment::find($id); 
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        
        if(!$appointment)  
            return $this->returnError('404',trans('global.flash.api.not_found'));
        
        if($appointment->client_id != $client->id){
            return $this->returnError('500','not auth');
        }
        if($appointment->date == date('Y-m-d')){
            return $this->returnError('404','لا يمكن حذف الطلب في يوم الزيارة');
        }
        $appointment->delete();
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
}
