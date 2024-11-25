<?php

namespace App\Http\Requests;

use App\Models\PropertyType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePropertyTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('property_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}