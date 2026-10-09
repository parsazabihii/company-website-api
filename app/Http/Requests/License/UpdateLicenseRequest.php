<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ];
    }
}
