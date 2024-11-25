<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
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
            'phone' => [
                'required',
                'regex:/^05\d{8}$/',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'password' => [
                'required',
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
            'job_num' => [
                'string',
                'nullable',
            ],
            'company_name' => [
                'string',
                'nullable',
            ],
            'company_field' => [
                'string',
                'nullable',
            ],
            'commerical_num' => [
                'string',
                'nullable',
            ],
            'manager_name' => [
                'string',
                'nullable',
            ],
            'manager_phone' => [
                'string',
                'nullable',
            ],
            'company_address' => [
                'string',
                'nullable',
            ],
            'company_website' => [
                'string',
                'nullable',
            ],
            'contract_start' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'contract_end' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'commissioner_name' => [
                'string',
                'nullable',
            ],
            'commissioner_nationality' => [
                'string',
                'nullable',
            ],
            'commissioner_id_number' => [
                'string',
                'nullable',
            ],
            'commissioner_id_start' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'commissioner_id_end' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'commissioner_job' => [
                'string',
                'nullable',
            ],
            'commissioner_phone' => [
                'string',
                'nullable',
            ],
        ];
    }
    public function messages()
    {
        return [
            'phone.regex' => 'The phone number must start with 05 and be 10 digits long.',
        ];
    }
}