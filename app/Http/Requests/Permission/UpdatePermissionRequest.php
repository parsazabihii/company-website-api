<?php

namespace App\Http\Requests\Permission;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
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
        $permission = $this->route('permission');
        $presenceRule = $this->isMethod('put') ? 'required' : 'sometimes';

        return [
            'name' => [
                $presenceRule,
                'string',
                'max:255',
            ],
            'slug' => [
                $presenceRule,
                'string',
                'max:255',
                Rule::unique('permissions', 'slug')->ignore($permission),
            ],
            'group_name' => [
                $presenceRule,
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }
}
