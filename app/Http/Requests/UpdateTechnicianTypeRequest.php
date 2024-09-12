<?php

namespace App\Http\Requests;

use App\Models\TechnicianType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTechnicianTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('technician_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
