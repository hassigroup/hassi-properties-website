<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    public const STATUSES = [
        'off-plan' => 'Off-plan',
        'ready' => 'Ready',
    ];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'handover_date' => 'date',
            'starting_price' => 'decimal:2',
            'gallery' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
