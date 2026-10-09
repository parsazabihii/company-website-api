<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'description', 'event_date',
        'meta_title', 'meta_description', 'og_image', 'status',
    ];

    protected function casts(): array
    {
        return ['event_date' => 'date'];
    }
}
