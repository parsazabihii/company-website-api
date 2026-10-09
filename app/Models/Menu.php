<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'icon',
        'display_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'parent_id' => 'integer',
            'display_order' => 'integer',
            'status' => 'integer',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            related: self::class,
            foreignKey: 'parent_id',
        );
    }

    public function children(): HasMany
    {
        return $this->hasMany(
            related: self::class,
            foreignKey: 'parent_id',
        )
            ->orderBy('display_order')
            ->orderBy('id');
    }
}
