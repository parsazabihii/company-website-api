<?php

namespace App\Http\Requests\Slider;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSliderRequest extends FormRequest
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
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'image' => [
                'sometimes',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'button_text' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'button_url' => [
                'sometimes',
                'nullable',
                'string',
                'max:2048',
            ],

            'display_order' => [
                'sometimes',
                'integer',
                'min:0',
            ],

            'status' => [
                'sometimes',
                'integer',
                Rule::in([0, 1]),
            ],
        ];
    }
}
