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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('status', 64)->nullable();
            $table->string('note', 512)->nullable();
            $table->string('shipping_type', 64)->nullable();
            $table->string('tracking_number', 128)->nullable();

            $table->string('country', 32);
            $table->string('city', 128);
            $table->string('adress_1', 128);
            $table->string('adress_2', 128)->nullable();
            $table->string('zip_code', 10);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
