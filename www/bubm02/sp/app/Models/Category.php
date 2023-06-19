<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function childCategories() : HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function items() : HasMany
    {
        return $this->hasMany(Item::class);
    }

    protected $fillable = [
        'name',
        'category_id',
    ];
}
