<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add missing fields
            $table->decimal('original_price', 10, 2)->nullable()->after('price');
            $table->boolean('is_on_sale')->default(false)->after('original_price');
            $table->integer('discount_percentage')->nullable()->after('is_on_sale');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Remove the fields added in the up method
            $table->dropColumn('original_price');
            $table->dropColumn('is_on_sale');
            $table->dropColumn('discount_percentage');
            
        });
    }
};