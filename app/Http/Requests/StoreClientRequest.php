<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'username' => [
                'nullable',
                'unique:users',
            ], 
            'password' => [
                'required',
                'min:6',
            ],
            'phone' => [
                'required',
                'regex:/^05\d{8}$/',
            ],
            'phone_2' => [
                'nullable',
                'regex:/^05\d{8}$/',
            ],

            'identity_num' => [
                'required',
                'numeric', 
                function ($attribute, $value, $fail) {
                    if ($this->input('nationality') === 'SA' && !preg_match('/^1\d{9}$/', $value)) {
                        $fail('The :attribute must start with 1 and be 10 digits long when the Nationality is Saudi.');
                    }
                },
            ],
            'nationality' => [
                'string',
                'required',
            ],
        ];
    }
}
