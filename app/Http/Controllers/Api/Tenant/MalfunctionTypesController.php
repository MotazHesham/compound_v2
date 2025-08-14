<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\MalfunctionTypeResource;
use App\Models\MalfunctionType;
use App\Traits\api_return;

class MalfunctionTypesController extends Controller
{
    use api_return; 

    public function all()
    {
        $malfunctionTypes = MalfunctionType::all();
        return $this->returnData(MalfunctionTypeResource::collection($malfunctionTypes));
    }
}
