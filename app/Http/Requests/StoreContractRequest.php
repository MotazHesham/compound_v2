<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\Contract;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContractRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contract_create');
    }

    public function rules()
    { 
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'nullable',
                'date_format:' . config('panel.date_format'),
            ],
            'num_of_visits' => [
                'required', 
            ],
            'chosen_day' => [
                'required',
                'min:1',
                'max:31',
            ],
            'time' => [
                'required',
                'in:'. implode(',',array_keys(Appointment::TIMES_SELECT)),
            ], 
        ];
    }
}
