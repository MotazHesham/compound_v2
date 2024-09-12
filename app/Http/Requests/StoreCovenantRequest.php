<?php

namespace App\Http\Requests;

use App\Models\Covenant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCovenantRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('covenant_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
