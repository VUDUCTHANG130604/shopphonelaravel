<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->unique()->after('id');
            }

            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('users', 'full_name')) {
                $table->string('full_name')->nullable()->after('name');
            }

            if (!Schema::hasColumn('users', 'image')) {
                $table->string('image')->nullable()->after('full_name');
            }

            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }

            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable()->after('phone');
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->integer('role')->default(0)->after('password');
            }

            if (!Schema::hasColumn('users', 'active')) {
                $table->boolean('active')->default(1)->after('role');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            foreach (['active', 'role', 'address', 'phone', 'image', 'full_name', 'username', 'user_id'] as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
