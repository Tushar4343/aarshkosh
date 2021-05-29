<?php

namespace App\Http\Requests;

use App\Models\Aarshgranth;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAarshgranthRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aarshgranth_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:aarshgranths,id',
        ];
    }
}
