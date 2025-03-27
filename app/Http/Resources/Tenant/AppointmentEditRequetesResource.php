<?php

namespace App\Http\Resources\Tenant;

use App\Models\AppointmentEditRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentEditRequetesResource extends JsonResource
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
            'appointment' => new AppointmentResource($this->appointment),
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status ? AppointmentEditRequest::STATUS_SELECT[$this->status] : '',
        ];
    }
}
