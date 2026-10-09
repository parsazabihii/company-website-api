<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'action' => $this->action,

            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->first_name . ' ' . $this->user?->last_name,
            ],

            'created_at' => $this->created_at,
        ];
    }
}
