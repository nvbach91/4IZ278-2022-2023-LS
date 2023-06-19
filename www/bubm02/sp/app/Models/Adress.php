<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_code',
        'city',
        'adress_1',
        'adress_2',
        'zip',
        'user_id',
    ];
}
