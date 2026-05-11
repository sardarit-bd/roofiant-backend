<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'city_id',
        'service_id',
        'title',
        'slug',
        'description',
        'location_address',
        'is_featured',
        'status',
        'meta_title',
        'meta_desc',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
