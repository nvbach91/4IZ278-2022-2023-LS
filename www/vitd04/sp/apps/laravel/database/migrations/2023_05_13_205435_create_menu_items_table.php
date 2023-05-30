<?php

use App\Models\Asset;
use App\Models\MenuSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->float('kcal');
            $table->float('protein');
            $table->float('carbs');
            $table->float('fat');
            $table->integer('amount_in_grams');
            $table->integer('position')->default(0);
            $table->foreignIdFor(MenuSection::class)->constrained()->onDelete('cascade');
            $table->unique(['menu_section_id', 'position']);
            $table->string('thumbnail_id');
            $table->foreign('thumbnail_id')->references('id')->on('assets')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};