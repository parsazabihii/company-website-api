<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token_type' => 'Bearer',
            'access_token' => $this->resource['access_token'],
            'access_token_expires_at' => $this->resource['access_token_expires_at'],
            'refresh_token' => $this->resource['refresh_token'],
            'refresh_token_expires_at' => $this->resource['refresh_token_expires_at'],
            'user' => UserResource::make($this->resource['user']),
        ];
    }
}
