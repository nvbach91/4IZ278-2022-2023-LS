<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand',
        'name',
        'description',
        'thumbnail',
        'price',
        'code',
        'discount',
        'stock',
        'category_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    public function getCategoryByProduct()
    {
        return $this->belongsTo(Category::class);
    }
    /*
    public static function sum($cart) {
        $sum = 0;
        foreach($cart as $id => $amount) {
            $sum += Product::find($id)->price * $amount;
        }

        return $sum;
    }
    */
};


