<?php

namespace App\Http\Requests;

use App\Models\Aarshchapter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAarshchapterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('aarshchapter_edit');
    }

    public function rules()
    {
        return [
            'granth_title_id' => [
                'required',
                'integer',
            ],
            'arshchapter_no' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'arshchapter_title' => [
                'string',
                'required',
            ],
        ];
    }
}
