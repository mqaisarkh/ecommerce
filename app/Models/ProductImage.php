<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $guarded = [];

    // Optionally define an accessor if you want to call it `path` in your code:
    public function getPathAttribute()
    {
        return $this->attributes['product_images'];
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
