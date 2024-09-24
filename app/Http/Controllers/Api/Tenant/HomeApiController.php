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

        $appointments = Appointment::where('client_id',$client->id)->orderBy('updated_at','desc')->take(4)->get();
        
        return $this->returnData(AppointmentResource::collection($appointments)); 
    } 
}
