<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpaceStation extends Model
{
    use HasFactory;

    /**
     * Get the galaxy that owns the space station.
     */
    public function galaxy(): BelongsTo
    {
        return $this->belongsTo(Galaxy::class);
    }
}