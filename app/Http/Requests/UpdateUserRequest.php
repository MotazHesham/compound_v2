<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
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
                'unique:users,email,' . request()->route('user')->id,
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'identity_num' => [
                'string',
                'nullable',
            ],
            'nationality' => [
                'string',
                'nullable',
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
}