<?php

namespace App\Http\Requests;

use App\Models\AarshDesc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAarshDescRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('aarsh_desc_edit');
    }

    public function rules()
    {
        return [
            'chapter_title_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
