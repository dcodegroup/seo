<?php

namespace Dcodegroup\SeoSettings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tag' => [
                'required',
                'max:255',
            ],
            'group' => [
                'sometimes',
                'max:255',
            ],
            'attributes' => [
                'required',
                'array',
            ],
            'value' => [
                'nullable',
            ]
        ];
    }
}