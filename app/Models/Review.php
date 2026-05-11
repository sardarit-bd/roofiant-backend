<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'customer_name',
        'rating',
        'review_text',
        'source',
        'status',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'rating'     => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
