<?php

namespace App\Http\Resources\Tenant;

use App\Models\exchangeOrder;
use App\Models\order;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceExchangeOrdersResource extends JsonResource
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
            'piece' => $this->Piece->name ?? '',  
            'quantity' => $this->quantity,  
            'price' => $this->price . ' SAR',  
        ];
    }
}
