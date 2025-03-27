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
        Schema::create('cards_deck', function (Blueprint $table) {
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            $table->foreignId('deck_id')->constrained('decks')->onDelete('cascade');
            $table->integer('amount');
            $table->primary(['card_id','deck_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards_deck');
    }
};
