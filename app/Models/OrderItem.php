<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'title',
        'price',
        'quantity',
        'image',
    ];

    // Optionally: define relationship
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
