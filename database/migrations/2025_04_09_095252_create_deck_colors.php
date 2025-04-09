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
        Schema::create('deck_colors', function (Blueprint $table) {
            $table->foreignId('deck_id')->nullable()->constrained('decks')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deck_colors');
    }
};
