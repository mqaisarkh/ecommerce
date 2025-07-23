<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });

        static::updating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function getShortDescriptionAttribute()
{
    return Str::limit(strip_tags($this->description), 25, '...');
}

public function getShortFeaturesAttribute()
{
    return Str::limit(strip_tags($this->features), 25, '...');
}

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('h:i A d-F-Y');
    }
}
