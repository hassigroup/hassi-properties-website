<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $guarded = [];

    public function communities(): HasMany
    {
        return $this->hasMany(Community::class);
    }

    public function internationalDetails(): HasMany
    {
        return $this->hasMany(InternationalDetail::class);
    }
}
