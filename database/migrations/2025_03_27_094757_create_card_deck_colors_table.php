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
        Schema::create('card_colors', function (Blueprint $table) {
            $table->foreignId('card_id')->nullable()->constrained('cards')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_deck_colors');
    }
};
