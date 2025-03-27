<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller; 
use App\Http\Resources\Tenant\AppointmentEditRequetesResource; 
use App\Models\Appointment; 
use App\Models\AppointmentEditRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentEditRequestsController extends Controller
{
    use api_return;     
    public function all(){

        $appointmentEditRequests = AppointmentEditRequest::with('appointment')->where('user_id',Auth::id())->paginate(15);
        
        return $this->returnData(AppointmentEditRequetesResource::collection($appointmentEditRequests)); 
    } 

    public function add(Request $request){
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id', 
            'date' => 'required|date_format:' . config('panel.date_format'), 
            'time' => 'required|in:'. implode(',',array_keys(Appointment::TIMES_SELECT)),  
        ]);
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        $appointment = Appointment::find($request->appointment_id);
        $appointmentDate =  Carbon::parse(Carbon::createFromFormat(config('panel.date_format'), $appointment->date)->format('Y-m-d'));  
        $now = Carbon::now();

        // مراعاة الاجازات الرسمية الجمعة والسبت
        while ($appointmentDate->isSaturday() || $appointmentDate->isSunday()) {
            $appointmentDate->subDay(); // Move further back if a holiday is encountered 
        } 

        if($appointment->client_id != $client->id){
            return $this->returnError('error', 'You are not allowed to edit this appointment.');
        } 
        // Ensure there are at least 2 working days 
        if ($this->businessDaysBetween($now, $appointmentDate) < 2) {
            return $this->returnError('error', 'لا يمكن تعديل الموعد قبل 48 ساعة عمل من موعد الحجز');
        }
        
        if(AppointmentEditRequest::where('appointment_id',$request->appointment_id)->first()){
            return $this->returnError('error', 'لا يمكن طلب تعديل نفس الموعد أكثر من مرة');
        }

        AppointmentEditRequest::create([
            'user_id' => Auth::id(),
            'appointment_id' => $request->appointment_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }

    public function delete($id){
        $appointmentEditRequest = AppointmentEditRequest::findOrFail($id); 
        if ($appointmentEditRequest->status == 'approved') {
            return $this->returnError('error', 'لا يمكن الحذف , تم الموافقة عليه');
        }
        $appointmentEditRequest->delete();
        return $this->returnSuccessMessage(trans('global.flash.api.success'));

    }

    
    // Function to calculate business days between two dates
    function businessDaysBetween($startDate, $endDate) {
        $days = 0;
        while ($startDate->lt($endDate)) {
            if (!$startDate->isFriday() && !$startDate->isSaturday()) {
                $days++;
            }
            $startDate->addDay();
        }
        return $days;
    }
}
