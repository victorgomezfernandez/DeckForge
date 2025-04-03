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
        Schema::create('mana_costs', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->foreignId('card_details_id')->constrained('card_details')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors');
            $table->primary(['card_details_id', 'color_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mana_costs');
    }
};
