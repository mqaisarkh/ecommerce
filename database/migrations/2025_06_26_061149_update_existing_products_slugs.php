<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $products = DB::table('products')->whereNull('slug')->orWhere('slug', '')->get();

        foreach ($products as $product) {
            $baseSlug = Str::slug($product->title);
            $slug = $baseSlug;
            $count = 1;

            // Ensure uniqueness
            while (DB::table('products')->where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            DB::table('products')
                ->where('id', $product->id)
                ->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {


    }
};

