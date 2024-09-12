<?php

namespace App\Http\Requests;

use App\Models\AppointmentCovenant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentCovenantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_covenant_create');
    }

    public function rules()
    {
        return [
            'quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
