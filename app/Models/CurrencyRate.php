<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'rate_to_aed' => 'decimal:8',
            'fetched_at' => 'datetime',
        ];
    }
}
