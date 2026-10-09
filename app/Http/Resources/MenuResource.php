<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,

            'title' => $this->title,
            'url' => $this->url,
            'icon' => $this->icon,

            'display_order' => (int) $this->display_order,
            'status' => (int) $this->status,

            'children' => MenuResource::collection(
                $this->whenLoaded('children')
            ),

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
