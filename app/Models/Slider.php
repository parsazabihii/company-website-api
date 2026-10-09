<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'description', 'image', 'button_text', 'button_url', 'display_order', 'status'];
}
