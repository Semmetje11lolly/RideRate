<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAverageRatingAttribute()
    {
        $ratings = [
            $this->rating_theme,
            $this->rating_design,
            $this->rating_ridexp,
            $this->rating_guestxp,
            $this->rating_creativity
        ];

        return round(collect($ratings)->avg(), 0);
    }
}
