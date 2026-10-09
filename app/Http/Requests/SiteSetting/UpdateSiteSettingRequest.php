<?php

namespace App\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'key' => 'required|string',
            'value' => 'required|string',
            'type' => 'required|string',
        ];
    }
}
