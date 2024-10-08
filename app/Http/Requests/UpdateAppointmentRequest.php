<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time' => [
                'required',
                'in:'. implode(',',array_keys(Appointment::TIMES_SELECT)),
            ], 
            'problem_photos' => [
                'array',
            ],
            'contract_id' => [
                'required',
                'integer',
            ], 
            'technicians.*' => [
                'integer',
            ],
            'technicians' => [
                'array',
            ],
        ];
    }
}
