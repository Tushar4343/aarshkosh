<?php

namespace App\Http\Requests;

use App\Models\Aarshgranth;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAarshgranthRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('aarshgranth_edit');
    }

    public function rules()
    {
        return [
            'aarsh_book_id' => [
                'required',
                'integer',
            ],
            'arshbook_no' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'arshbook_title' => [
                'string',
                'required',
            ],
        ];
    }
}
