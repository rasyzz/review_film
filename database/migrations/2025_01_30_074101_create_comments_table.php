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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id_comments');
            $table->text('comment');
            $table->enum('rating', [1, 2, 3, 4, 5]);
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_film')->constrained('films', 'id_film')->onDelete('cascade'); // Ubah 'film' menjadi 'films'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
