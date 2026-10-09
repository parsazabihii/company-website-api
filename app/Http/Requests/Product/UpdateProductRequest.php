<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine whether the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'slug')
                    ->ignore($this->route('product')),
            ],

            'image' => [
                'sometimes',
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'short_description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'description' => [
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
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'status' => [
                'sometimes',
                'required',
                'integer',
                Rule::in([0, 1]),
            ],
        ];
    }
}
