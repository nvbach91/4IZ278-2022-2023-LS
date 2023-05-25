<?php

use App\Models\Galaxy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('space_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('x');
            $table->float('y');
            $table->float('z');
            $table->string('image_url');
            $table->foreignIdFor(Galaxy::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_stations');
    }
};