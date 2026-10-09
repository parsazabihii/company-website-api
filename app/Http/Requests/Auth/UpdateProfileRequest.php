<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'required_without:last_name',
                'filled',
                'string',
                'max:255',
            ],

            'last_name' => [
                'required_without:first_name',
                'filled',
                'string',
                'max:255',
            ],

            'avatar' => [
                'sometimes',
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];
    }
}
