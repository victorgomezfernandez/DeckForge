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
        Schema::create('legalities', function (Blueprint $table) {
            $table->foreignId('card_id')->constrained('cards')->onDelete('cascade');
            $table->foreignId('format_id')->constrained('formats');
            $table->foreignId('legality_status_id')->constrained('legality_statuses');
            $table->primary(['card_id', 'format_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legalities');
    }
};
