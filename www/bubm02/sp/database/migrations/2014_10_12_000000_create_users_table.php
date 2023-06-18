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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('password', 256)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('isic_number', 32)->nullable();
            $table->timestamp('discount_expiration')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->default("user");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
