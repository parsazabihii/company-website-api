<?php

namespace App\Http\Requests\AboutUs;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutUsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                'sometimes',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'content' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'meta_title' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'og_image' => [
                'sometimes',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ];
    }
}
