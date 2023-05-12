<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'datetime',
        'place',
        'city',
        'country'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'datetime' => 'datetime'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getDateAttribute()
    {
        return $this->datetime->format('M jS');
    }

    public function getTimeAttribute()
    {
        return $this->datetime->format('H:i');
    }

    public function scopeRelevant($query)
    {
        $query->whereDate('datetime', '>', now());
    }

    public function scopeNearest($query)
    {
        $query->orderBy('datetime', 'asc');
    }
}
