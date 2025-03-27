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
        Schema::create('color_identities', function (Blueprint $table) {
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors');
            $table->primary(['card_id','color_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_identities');
    }
};
