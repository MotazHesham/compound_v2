<?php

namespace App\Http\Requests;

use App\Models\AppointmentEditRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAppointmentEditRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('appointment_edit_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:appointment_edit_requests,id',
        ];
    }
}