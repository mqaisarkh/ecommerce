<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;


    protected $guarded = [];


    public function getRouteKeyName()
    {
        return 'slug';
    }


    protected static function booted()
    {

        static::creating(function ($category) {
            $category->slug = static::generateUniqueSlug($category->name);
        });


        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = static::generateUniqueSlug($category->name, $category->id);
            }
        });
    }

    /**
     *
     *
     *  @param string
     *  @param int|null
     */
    protected static function generateUniqueSlug(string $name, $ignoreId = null): string
    {
        $slug         = Str::slug($name);
        $originalSlug = $slug;
        $counter      = 1;


        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }



    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function blogs()
{
    return $this->hasMany(Blog::class);
}
}
