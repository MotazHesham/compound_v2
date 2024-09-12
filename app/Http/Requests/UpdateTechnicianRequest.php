<?php

namespace App\Http\Requests;

use App\Models\Technician;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTechnicianRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('technician_edit');
    }

    public function rules()
    {
        return [
            'technician_type_id' => [
                'required',
                'integer',
            ],
            'identity_num' => [
                'string',
                'nullable',
            ],
        ];
    }
}
