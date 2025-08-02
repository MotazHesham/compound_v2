<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'alert_text' => $this->alert_text,
            'alert_link' => $this->alert_link,
            'created_at' => $this->created_at->format('Y-m-d H:i:s') ?? '', 
        ];
    }
}
