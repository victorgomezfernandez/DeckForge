<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('collector_number')->nullable(true);
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'mythic'])->nullable(true);
            $table->text('img')->nullable(true);
            $table->text('art_crop')->nullable(true);
            $table->string('layout', 20)->nullable(true);
            $table->double('mana_value')->nullable(true);
            $table->date('released_at')->nullable(true);
            $table->foreignId('set_id')->constrained('sets')->onDelete('cascade');
            $table->text('oracle_id');
            $table->string('lang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
