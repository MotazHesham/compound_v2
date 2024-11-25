<?php

namespace App\Http\Requests;

use App\Models\PropertyType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPropertyTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('property_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:property_types,id',
        ];
    }
}