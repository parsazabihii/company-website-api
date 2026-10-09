<?php

namespace App\Http\Requests\Menu;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuRequest extends FormRequest
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
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('menus', 'id'),
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'url' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
            ],

            'display_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                'integer',
                Rule::in([0, 1]),
            ],
        ];
    }
}
