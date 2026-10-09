<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyReview extends Model
{
    protected $fillable = ['review_id', 'user_id', 'reply'];

    public function review()
    {
        return $this->belongsTo(ClientReview::class, 'review_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
