<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galaxy extends Model
{
    use HasFactory;

    /**
     * Get the space stations for the galaxy.
     */
    public function spaceStations(): HasMany
    {
        return $this->hasMany(SpaceStation::class);
    }
}