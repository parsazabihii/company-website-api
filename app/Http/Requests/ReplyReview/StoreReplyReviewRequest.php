<?php

namespace App\Http\Requests\ReplyReview;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplyReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reply' => [
                'required',
                'string',
            ],
        ];
    }
}
