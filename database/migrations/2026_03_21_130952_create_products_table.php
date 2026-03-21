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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price'); // Storing exactly as '$45.00' for quick parity with mock
            $table->string('original_price')->nullable(); // e.g., '$89.00'
            $table->string('sales'); // Storing as '2.4k' for quick parity with mock
            $table->string('image');
            $table->string('category')->default('Electronics');
            $table->text('description')->nullable();
            $table->json('colors')->nullable();
            $table->decimal('rating', 2, 1)->default(5.0);
            $table->integer('reviews_count')->default(0);
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('free_shipping')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
