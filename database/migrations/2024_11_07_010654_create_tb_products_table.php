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
        Schema::create('tb_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->json('images')->nullable();
            $table->text('description')->nullable(); 
            $table->decimal('price', 10, 2)->nullable(); 
            $table->decimal('price_after_discount', 10, 2)->nullable(); 
            $table->integer('quantity');
            $table->boolean('is_price_visible')->default(true); 
            $table->boolean('is_active')->default(true); 
            $table->integer('sub_category_id');
            $table->integer('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_products');
    }
};
