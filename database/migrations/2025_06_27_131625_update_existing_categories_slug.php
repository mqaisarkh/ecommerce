<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    $categories = DB::table('categories')->get();

    foreach ($categories as $category) {
        DB::table('categories')
            ->where('id', $category->id)
            ->update([
                'slug' => Str::slug($category->name)
            ]);
    }
}

public function down()
{
    // Optionally reset slugs to null or previous values
    DB::table('categories')->update(['slug' => null]);
}
};
