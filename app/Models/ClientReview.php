<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    protected $fillable = ['full_name', 'company', 'image', 'comment'];

    public function replies()
    {
        return $this->hasMany(ReplyReview::class, 'review_id');
    }
}
