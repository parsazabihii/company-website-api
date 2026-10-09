<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubBrandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'logo'=>$this->logo,
            'website'=>$this->website,
            'created_at'=>$this->created_at,
        ];
    }
}
