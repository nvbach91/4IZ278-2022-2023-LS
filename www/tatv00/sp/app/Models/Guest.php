<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'email',
        'name',
        'address',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
