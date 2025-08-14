<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $client = $this->client;

        return [
            'id' => $this->id, 
            'name' => $this->name ?? '',
            'phone' => $this->phone ?? '',
            'email' => $this->email ?? '',
            'contract' => optional($client?->clientContracts()?->latest('created_at')->first())->only([
                'id', 'start_date', 'end_date', 'status'
            ]),
            'address' => $client?->address ?? '',
            'photo' => $this->getFirstMediaUrl('photo') ?? '',
        ];
    }
}
