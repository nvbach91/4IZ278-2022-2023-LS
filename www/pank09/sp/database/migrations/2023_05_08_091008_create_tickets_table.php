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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->unsignedDecimal('price');
            $table->unsignedMediumInteger('available_amount');
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
        Schema::dropIfExists('tickets');
    }
};
