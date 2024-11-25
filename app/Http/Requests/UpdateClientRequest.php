<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_edit');
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
                'unique:users,email,' . request()->user_id,
            ],
            'username' => [
                'nulalble',
                'unique:users,username,' . request()->user_id,
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'phone2' => [
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
