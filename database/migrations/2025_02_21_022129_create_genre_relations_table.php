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
        Schema::create('genre_relations', function (Blueprint $table) {
            $table->increments('id');
            // Gunakan unsignedBigInteger agar sesuai dengan tipe bigIncrements
            $table->unsignedBigInteger('id_film');
            $table->unsignedBigInteger('id_genre');
            $table->timestamps();
    
            // Pastikan nama tabel dan kolomnya sesuai (misalnya 'films' dan 'genres')
            $table->foreign('id_film')->references('id_film')->on('films')->onDelete('cascade');
            $table->foreign('id_genre')->references('id_genre')->on('genres')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('genre_relations');
    }
    
};