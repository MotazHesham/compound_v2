<?php

namespace App\Http\Requests;

use App\Models\AppointmentEditRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentEditRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_edit_request_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'appointment_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'status' => [
                'required',
            ],
        ];
    }
}