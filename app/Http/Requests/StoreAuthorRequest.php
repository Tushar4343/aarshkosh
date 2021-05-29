<?php

namespace App\Http\Requests;

use App\Models\Author;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAuthorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('author_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
