<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('role')?->id;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $roleId,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام نقش الزامی است.',
            'slug.required' => 'اسلاگ الزامی است.',
            'slug.unique' => 'این اسلاگ قبلاً استفاده شده است.',
        ];
    }
}
