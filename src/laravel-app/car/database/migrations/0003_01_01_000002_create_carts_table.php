<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            // legacy: cart_id
            $table->id('cart_id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');

            $table->string('product_name');
            $table->decimal('product_price', 15, 0)->default(0);
            $table->integer('product_quantity')->default(1);
            $table->string('product_image')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->index(['user_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

