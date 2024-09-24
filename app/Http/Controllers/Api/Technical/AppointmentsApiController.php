<?php

namespace App\Http\Controllers\Api\Technical;

use App\Http\Controllers\Controller;
use App\Http\Resources\Technical\AppointmentResource;
use App\Http\Resources\Technical\OrderResource;
use App\Http\Resources\Technical\CovenantResource;
use App\Models\Appointment;
use App\Models\AppointmentCovenant;
use App\Models\Covenant;
use App\Models\Technician;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentsApiController extends Controller
{
    use api_return;    

    public function covenants(){
        $technician = Technician::where('user_id', Auth::id())->firstOrFail();
        $covenants = Covenant::where('technician_id',$technician->id)->get();
        $resource = CovenantResource::collection(resource: $covenants);  
        return $this->returnData($resource,'success');
    }

    public function appointments(){  
        $technician = Technician::where('user_id', Auth::id())->firstOrFail();

        $appointments = Appointment::with(['appointmentAppointmentCovenants','client.user'])
                                ->whereHas('technicians',function($query) use($technician){
                                    return $query->where('technician_id',$technician->id);
                                })
                                ->whereIn('status',['pending','working'])
                                ->orderBy('updated_at','desc')
                                ->paginate(15);

        $resource = AppointmentResource::collection($appointments);  

        return $this->returnPaginationData($resource,$appointments,'success'); 
    }  

    public function closed(){  
        $technician = Technician::where('user_id', Auth::id())->firstOrFail();

        $appointments = Appointment::with(['appointmentAppointmentCovenants','client.user'])
                                ->whereHas('technicians',function($query) use($technician){
                                    return $query->where('technician_id',$technician->id);
                                })
                                ->where('status','completed')
                                ->orderBy('updated_at','desc')
                                ->paginate(15);

        $resource = AppointmentResource::collection($appointments);  
        return $this->returnPaginationData($resource,$appointments,'success'); 
    }  

    public function open(){  
        $technician = Technician::where('user_id', Auth::id())->firstOrFail();

        $appointments = Appointment::with(['appointmentAppointmentCovenants','client.user'])
                                ->whereHas('technicians',function($query) use($technician){
                                    return $query->where('technician_id',$technician->id);
                                })
                                ->whereIn('status',['pending','working'])
                                ->orderBy('updated_at','desc')
                                ->paginate(15);

        $resource = AppointmentResource::collection($appointments);  

        return $this->returnPaginationData($resource,$appointments,'success'); 
    }  

    
    public function add_part(Request $request){
        
        $rules = [   
            'appointment_id' => 'integer|required|exists:appointments,id', 
            'covenant_id'=> 'integer|required|exists:covenants,id',
            'quantity' => 'required|integer',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  
        $covenant = Covenant::findOrFail($request->covenant_id);


        $appointmentCovenant = new AppointmentCovenant;

        $appointmentCovenant->appointment_id = $request->request_id;
        $appointmentCovenant->covenant_id = $request->covenant_id;
        $appointmentCovenant->quantity = $request->quantity;   
        if($appointmentCovenant->save()){
            $covenant->quantity -= $request->quantity;
            $covenant->save();
        }
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    
    public function status(Request $request){
        
        $rules = [   
            'appointment_id' => 'integer|required',
            'status'=> 'required|in:working,completed',  
        ];

        if($request->status == 'completed'){
            $rules['token'] = 'required|min:6|integer';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  

        $appointment = Appointment::findOrFail($request->appointment_id);

        if($request->status == 'completed'){ 
            if($appointment->finish_code != $request->token){
                return $this->returnError('401', 'invalid token!');
            } 
            if($request->has('images')){ 
                foreach ($request->images as $key => $image) { 
                    $appointment->addMedia($image)->toMediaCollection('problem_photos_by_tech');
                }
            }
        }
        $appointment->status = $request->status;
        $appointment->problem_description_by_tech = $request->issue_description; 
        $appointment->save();   
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
}
