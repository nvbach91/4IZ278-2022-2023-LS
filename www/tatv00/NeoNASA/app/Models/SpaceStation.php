<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceStation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'gps_3d_coordinates', 'image_url', 'description', 'galaxy_id'];

    public function galaxy()
    {
        return $this->belongsTo(Galaxy::class);
    }
}
