<?php

namespace Dcodegroup\SeoSettings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoDataRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'max:255',
            ],
            'description' => [
                'sometimes',
            ],
            'keywords' => [
                'sometimes',
            ],
            'image' => [
                'sometimes',
            ],
            'author' => [
                'sometimes',
                'max:255',
            ],
            'copyright' => [
                'sometimes',
                'max:255',
            ],
            'date' => [
                'sometimes',
                'max:255',
            ],
            'region' => [
                'sometimes',
                'max:255',
            ],
            'url' => [
                'sometimes',
                'max:255',
            ],
            'markup' => [
                'sometimes',
            ],
        ];
    }
}