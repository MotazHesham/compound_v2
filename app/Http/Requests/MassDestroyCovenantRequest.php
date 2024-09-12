<?php

namespace App\Http\Requests;

use App\Models\Covenant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCovenantRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('covenant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:covenants,id',
        ];
    }
}
