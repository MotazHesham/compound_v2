<?php

namespace App\Http\Resources\Technical;

use App\Models\Appointment;
use App\Models\order;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 

        return [
            'id' => $this->id,
            'problem_description' => $this->problem_description,
            'service_type' => $this->type ? trans('panel.type.'.$this->type) : '', 
            'time' => $this->time,
            'date' => $this->date,
            'status_code' => $this->status ?? '', 
            'status' => $this->status ? trans('panel.status.'.$this->status) : '',
            'address' => $this->client->address ?? '',
            'phone' => $this->client->user->phone ?? '',
        ];
    }
}
