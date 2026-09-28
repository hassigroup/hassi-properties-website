<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{
    protected $fillable = [
        'property_id',
        'source',
        'name',
        'email',
        'phone',
        'message',
        'meta',
        'zoho_lead_id',
        'zoho_sync_status',
        'zoho_synced_at',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'zoho_synced_at' => 'datetime',
        ];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
