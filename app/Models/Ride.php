<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ride extends Model
{
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function experiences(): Ride|HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
