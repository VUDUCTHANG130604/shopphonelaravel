<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            // legacy: order_id
            $table->id('order_id');

            $table->unsignedBigInteger('user_id');

            // legacy model uses columns: total, address, phone, note, status, date
            $table->decimal('total', 15, 0)->default(0);
            $table->string('address');
            $table->string('phone');
            $table->text('note')->nullable();
            $table->integer('status')->default(0);

            $table->timestamp('date')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();

            $table->index(['user_id', 'order_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

