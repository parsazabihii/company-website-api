<?php

namespace App\Http\Requests\Slider;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSliderRequest extends FormRequest
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
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'button_text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'button_url' => [
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
