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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description');
            $table->string('image');
            $table->string('place');
            $table->string('city');
            $table->string('country');
            $table->dateTime('datetime');
            $table->unsignedBigInteger('lock_opened_by')->nullable()->default(null);
            $table->time('lock_opened_at')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('lock_opened_by')->references('id')->on('users')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
