<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'name',
        'description',
        'img',
        'category_id',

    ];

    public function priceKc() {
        return Product::toKc($this->price);
    }

    public static function toKc($amount) {
        return $amount . " Kč";
    }

    public static function sumKc($cart) {
        $sum = 0;
        foreach($cart as $id => $amount) {
            $sum += Product::find($id)->price * $amount;
        }

        return Product::toKc($sum);

    }

    

}
