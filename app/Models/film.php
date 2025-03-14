<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class film extends Model

{
    use HasFactory, SoftDeletes;

    protected $table = 'films';
    protected $primaryKey = 'id_film';
    protected $fillable = ['title', 'poster', 'description', 'release_year', 'duration', 'rating', 'creator', 'trailer'];

    public function castings()
    {
        return $this->hasMany(Castings::class, 'id_film');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_film');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_relations', 'id_film', 'id_genre');
    }
    
}
