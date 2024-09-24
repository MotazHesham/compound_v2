<?php

namespace App\Http\Resources\Tenant;

use App\Models\exchangeOrder;
use App\Models\order;
use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        $images = [];
        if($this->images){
            foreach(json_decode($this->images) as $image){
                $images[] = get_baseUrl() . str_replace('public','/public/storage',$image);
            }
        }
        return [
            'id' => $this->id,
            'piece' => $this->Piece->name ?? '', 
            'part_from' => $this->part_from, 
            'status' => $this->status ? exchangeOrder::STATUS_SELECT[$this->status] : '', 
            'part_type' => $this->type ? exchangeOrder::TYPE_SELECT[$this->type] : '', 
            'description' => $this->description, 
            'quantity' => $this->quantity, 
            'reason' => $this->reason, 
            'price' => $this->price, 
            'created_at' =>  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d h:i a'), 
            'images' => $images, 
        ];
    }
}
