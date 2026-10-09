<?php

namespace App\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'key' => 'required|string|unique:site_settings,key',
            'value' => 'required|string',
            'type' => 'required|string',
        ];
    }
}
