<?php

namespace App\Http\Requests\ClientReview;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientReviewRequest extends FormRequest
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
            'full_name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],

            'company' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'image' => [
                'sometimes',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'comment' => [
                'sometimes',
                'required',
                'string',
            ],
        ];
    }
}
