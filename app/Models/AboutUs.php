<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'title',
        'image',
        'content',
        'meta_title',
        'meta_description',
        'og_image',
    ];
}
