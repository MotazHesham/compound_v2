<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Traits\api_return;
use App\Http\Resources\Tenant\ContractResource;

class ContractsController extends Controller
{
    use api_return;
    
    public function all()
    {
        $client = Client::where('user_id',Auth::id())->firstOrFail();
        $contracts = Contract::where('client_id', $client->id)->orderBy('id','desc')->get();
        return $this->returnData(ContractResource::collection($contracts));
    }
}
