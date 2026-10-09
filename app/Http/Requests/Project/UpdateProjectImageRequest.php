<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => ['sometimes', 'string', 'max:255'],
            'display_order' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
