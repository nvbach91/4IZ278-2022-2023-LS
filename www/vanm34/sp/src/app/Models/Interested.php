<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interested extends Model
{
    protected $table = 'interested';

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    protected $fillable = ['property_id', 'user_id'];
}
