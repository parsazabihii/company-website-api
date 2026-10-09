<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['service_id', 'question', 'answer', 'display_order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
