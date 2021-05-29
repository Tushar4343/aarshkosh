<?php

namespace App\Http\Requests;

use App\Models\Aarshbook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAarshbookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('aarshbook_edit');
    }

    public function rules()
    {
        return [
            'language_id' => [
                'required',
                'integer',
            ],
            'aarsh_book' => [
                'string',
                'required',
            ],
        ];
    }
}
