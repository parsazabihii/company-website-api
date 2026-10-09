<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AboutUsResource extends JsonResource
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

            'title' => $this->title,

            'image_url' => $this->image ? Storage::disk('public')->url($this->image) : null,

            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,

            'og_image_url' => $this->og_image ? Storage::disk('public')->url($this->og_image) : null,

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
