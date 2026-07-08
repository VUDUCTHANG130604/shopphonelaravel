<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();

            // legacy: user_id, address
            $table->unsignedBigInteger('user_id');
            $table->string('address', 255);

            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->index(['user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};

