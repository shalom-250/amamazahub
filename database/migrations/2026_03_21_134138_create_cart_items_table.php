<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->string('color')->nullable();
            $table->timestamps();
            
            // A user can only have one cart record per distinct product+color combination
            $table->unique(['user_id', 'product_id', 'color']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
