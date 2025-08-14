<?php

namespace App\Http\Requests;

use App\Models\MalfunctionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMalfunctionTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('malfunction_type_create');
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
