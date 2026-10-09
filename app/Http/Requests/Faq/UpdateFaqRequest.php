<?php

namespace App\Http\Requests\Faq;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFaqRequest extends FormRequest
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
            'service_id' => [
                'sometimes',
                'nullable',
                'integer',
                Rule::exists('services', 'id'),
            ],

            'question' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],

            'answer' => [
                'sometimes',
                'required',
                'string',
            ],

            'display_order' => [
                'sometimes',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}
