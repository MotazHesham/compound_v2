<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'chosen_day' => $this->chosen_day,
            'time' => $this->time,
            'num_of_visits' => $this->num_of_visits,
            'services' => $this->services,
            'status' => $this->status,
            'contract_file' => $this->contract_file ? $this->contract_file->getUrl() : '',
        ];
    }
}
