<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'icon',
        'meta_title',
        'meta_desc',
        'sort_order',
        'status',
    ];


    protected $casts = [
        'status' => 'boolean',
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }


    public function children(): HasMany
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'city_service');
    }
}
