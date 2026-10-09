<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'short_description', 'description',
        'meta_title', 'meta_description', 'og_image', 'status',
    ];

//    public function parent()
//    {
//        return $this->belongsTo(Product::class, 'parent_id');
//    }
//
//    public function children()
//    {
//        return $this->hasMany(Product::class, 'parent_id');
//    }
}
