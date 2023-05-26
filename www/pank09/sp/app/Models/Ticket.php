<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'price',
        'available_amount'
    ];

    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getFormattedPriceAttribute()
    {
        return sprintf('%s %s', number_format($this->price, 2), env('APP_CURRENCY'));
    }

    public function getRemainingAmountAttribute()
    {
        return $this->available_amount - $this->bookings()->sum('amount');
    }

    public function orderByPrice($query)
    {
        $query->orderBy('price', 'desc');
    }
}
