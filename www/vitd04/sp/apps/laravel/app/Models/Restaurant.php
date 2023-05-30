<?php

namespace App\Models;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Restaurant extends Model
{
    use HasFactory;
    use HasUuids;
    use HasSpatial;

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'thumbnail_id',
        'location',
        'address',
        'city',
        'zip',
        'visible',
    ];

    protected $casts = [
        'location' => Point::class,
    ];

    function menuSections(): HasMany
    {
        return $this->hasMany(MenuSection::class);
    }

    function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}