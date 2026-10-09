<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'image',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'og_image',
        'display_order',
        'status',
    ];

    /**
     * Get the features belonging to this service.
     */
    public function features(): HasMany
    {
        return $this->hasMany(ServiceFeature::class)
            ->orderBy('display_order');
    }

    /**
     * Get the FAQs belonging to this service.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)
            ->orderBy('display_order');
    }

    protected function casts(): array
    {
        return [
            'status' => 'integer',
            'display_order' => 'integer',
        ];
    }
}
