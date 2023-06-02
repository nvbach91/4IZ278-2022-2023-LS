<?php

namespace App\Models;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'user_id',
        'restaurant_id',
    ];

    function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}