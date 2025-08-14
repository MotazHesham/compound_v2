<?php

namespace App\Http\Requests;

use App\Models\MalfunctionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMalfunctionTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('malfunction_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:malfunction_types,id',
        ];
    }
}
