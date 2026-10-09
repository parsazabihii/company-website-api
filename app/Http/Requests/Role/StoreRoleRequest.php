<?php

namespace App\Http\Requests\Role;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name'),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'slug'),
            ],
            'permission_ids' => [
                'required',
                'array',
            ],
            'permission_ids.*' => [
                'integer',
                'distinct',
                Rule::exists('permissions', 'id'),
            ],
        ];
    }
}
