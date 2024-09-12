<?php

namespace App\Http\Requests;

use App\Models\TechnicianType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTechnicianTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('technician_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:technician_types,id',
        ];
    }
}
