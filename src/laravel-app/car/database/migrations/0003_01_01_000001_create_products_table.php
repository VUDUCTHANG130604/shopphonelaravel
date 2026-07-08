<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // legacy: product_id
            $table->id('product_id');

            $table->string('name');
            $table->string('image')->nullable();

            $table->decimal('sale_price', 15, 0)->default(0);
            $table->decimal('price', 15, 0)->default(0);
            $table->integer('status')->default(1);

            $table->unsignedBigInteger('category_id')->nullable();

            $table->integer('quantity')->default(0);
            $table->integer('sell_quantity')->default(0);
            $table->integer('views')->default(0);
            $table->text('short_description')->nullable();
            $table->longText('details')->nullable();
            $table->timestamp('create_date')->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

