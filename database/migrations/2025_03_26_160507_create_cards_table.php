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
            $table->integer('collector_number')->notNull();
            $table->enum('rarity', ['common', 'uncommon', 'rare', 'mythic'])->notNull();
            $table->text('img_url')->notNull();
            $table->string('layout', 20)->notNull();
            $table->integer('mana_value')->notNull();
            $table->date('released_at')->notNull();
            $table->foreignId('set_id')->constrained('sets')->onDelete('cascade');
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
