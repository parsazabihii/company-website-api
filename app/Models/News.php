<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'image', 'thumbnail', 'content', 'status',
        'published_at', 'meta_title', 'meta_description', 'og_image',
    ];

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }
}
