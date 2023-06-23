<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'description',
        'properties',
        'price',
        'category_id',
    ];

    public function batchGetById($id) {
        return Item::all()->where('id', $id);
    }

    public function priceKc() {
        return Item::localPriceKc($this->price);
    }

    public function discountPriceKc() {
        return Item::localPriceKc($this->discount_price);
    }

    public static function sumPriceKc($itemArray) {
        if ($itemArray == null) {
            return Item::localPriceKc(0);
        } elseif (count($itemArray) == 0) {
            return Item::localPriceKc(0);
        } else {
            $sum = 0;
            foreach ($itemArray as $item) {
                $sum += $item->price;
            }
            return Item::localPriceKc($sum);
        }
    }
    public static function sumDiscountKc($itemArray) {
        if ($itemArray == null) {
            return Item::localPriceKc(0);
        } elseif (count($itemArray) == 0) {
            return Item::localPriceKc(0);
        } else {
            $sum = 0;
            foreach ($itemArray as $item) {
                if ($item->discount_price > 0) {
                    $sum += $item->price - $item->discount_price;
                }
            }
            return Item::localPriceKc($sum);
        }
    }

    public static function sumTotalKc($itemArray) {
        if ($itemArray == null) {
            return Item::localPriceKc(0);
        } elseif (count($itemArray) == 0) {
            return Item::localPriceKc(0);
        } else {
            $sum = 0;
            foreach ($itemArray as $item) {
                if ($item->discount_price > 0) {
                    $sum += $item->discount_price;
                } else {
                    $sum += $item->price;
                }
            }
            return Item::localPriceKc($sum);
        }
    }

    private static function localPriceKc($price) {
        return $price . ' Kč';
    }
}
