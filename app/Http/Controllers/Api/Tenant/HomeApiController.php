<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller; 
use App\Http\Resources\Tenant\AppointmentResource;
use App\Http\Resources\Tenant\SliderResource;
use App\Models\Appointment; 
use App\Models\Client; 
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Illuminate\Support\Facades\Auth;

class HomeApiController extends Controller
{
    use api_return;    

    public function sliders(Request $request){

        $sliders = Slider::where('publish',1)->get();
        
        return $this->returnData(SliderResource::collection($sliders)); 
    }  
    public function appointments(Request $request){

        $client = Client::where('user_id',Auth::id())->firstOrFail();

        $appointments = Appointment::where('client_id',$client->id)->whereIn('status',['pending','working'])->orderBy('date','asc')->take(4)->get();
        
        return $this->returnData(AppointmentResource::collection($appointments)); 
    } 
    public function appointmentStats(Request $request){
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        $appointments = Appointment::selectRaw('count(*) as total,
            SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = "working" THEN 1 ELSE 0 END) as working,
            SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed,
            SUM(CASE WHEN status = "canceled" THEN 1 ELSE 0 END) as canceled')
        ->where('client_id',$client->id)
        ->first();
        return $this->returnData([
            'pending' => (int)$appointments->pending,
            'working' => (int)$appointments->working,
            'completed' => (int)$appointments->completed,
            'canceled' => (int)$appointments->canceled,
            'total' => (int)$appointments->total,
        ]); 
    }
}
