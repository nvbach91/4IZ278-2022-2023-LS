<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    public function adress() : HasOne
    {
        return $this->hasOne(Adress::class);
    }

    public function items() : BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'order_items');
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
