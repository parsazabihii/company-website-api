<?php

namespace App\Http\Requests\Menu;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuRequest extends FormRequest
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
        $menuId = (int) $this->route('menu');

        return [
            'parent_id' => [
                'sometimes',
                'nullable',
                'integer',
                Rule::exists('menus', 'id'),
                Rule::notIn([$menuId]),
            ],

            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],

            'url' => [
                'sometimes',
                'nullable',
                'string',
                'max:2048',
            ],

            'icon' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'display_order' => [
                'sometimes',
                'required',
                'integer',
                'min:0',
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
