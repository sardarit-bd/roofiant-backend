<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class City extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'state',
        'zip_code',
        'description',
        'meta_title',
        'meta_desc',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'city_service');
    }
}
