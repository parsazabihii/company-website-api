<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ClientReviewResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'full_name' => $this->full_name,
            'company' => $this->company,

            'image_url' => $this->image ? Storage::disk('public')->url($this->image) : null,

            'comment' => $this->comment,

            'replies' => ReplyReviewResource::collection($this->whenLoaded('replies')),

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
