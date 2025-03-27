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
        Schema::create('card_details_types', function (Blueprint $table) {
            $table->foreignId('type_id')->constrained('types');
            $table->foreignId('card_details_id')->constrained('card_details')->onDelete('cascade');
            $table->primary(['type_id','card_details_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_details_types');
    }
};
