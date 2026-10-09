<?php

namespace App\Http\Requests\TeamMember;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],

            'position' => [
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

            'bio' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'linkedin' => [
                'sometimes',
                'nullable',
                'url',
                'max:255',
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
