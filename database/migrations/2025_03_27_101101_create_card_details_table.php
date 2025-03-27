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
        Schema::create('card_details', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('power', 3)->nullable(true);
            $table->string('toughness', 3)->nullable(true);
            $table->integer('loyalty')->nullable(true);
            $table->integer('defense')->nullable(true);
            $table->text('oracle_text')->nullable(true);
            $table->text('flavor_text')->nullable(true);
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_details');
    }
};
