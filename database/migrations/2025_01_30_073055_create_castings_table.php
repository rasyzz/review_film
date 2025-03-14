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
        Schema::create('castings', function (Blueprint $table) {
            $table->id('id_castings');
            $table->string('stage_name');
            $table->string('real_name');
            $table->foreignId('id_film')->constrained('films', 'id_film')->onDelete('cascade'); // Ubah 'film' menjadi 'films'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('castings');
    }
};
