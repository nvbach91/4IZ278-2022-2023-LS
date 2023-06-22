<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    public function adress()
    {
        return Adress::find($this->adress_id);
    }

    public function items() : array
    {
        return $this
            ->belongsToMany(Item::class, 'order_items')
            ->get(['order_id', 'item_id', 'old_price', 'quantity'])
            ->all();
    }

    public function itemsBelong()
    {
        return $this
            ->belongsToMany(Item::class, 'order_items');
    }

    protected $fillable = [
        'type',
        'status',
        'note',
        'shipping_type',
        'tracking_number',
        'target_adress_id',
    ];
}
