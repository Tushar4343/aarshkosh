<?php

namespace App\Http\Requests;

use App\Models\AarshDesc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAarshDescRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aarsh_desc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:aarsh_descs,id',
        ];
    }
}
