<?php

use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->point('location');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('thumbnail_id');
            $table->foreign('thumbnail_id')->references('id')->on('assets')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->index(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};