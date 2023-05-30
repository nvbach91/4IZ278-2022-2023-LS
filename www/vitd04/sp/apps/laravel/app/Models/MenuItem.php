<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'kcal',
        'protein',
        'carbs',
        'fat',
        'amount_in_grams',
        'menu_section_id',
        'thumbnail_id',
        'position'
    ];

    public function menuSection(): BelongsTo
    {
        return $this->belongsTo(MenuSection::class);
    }

    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}