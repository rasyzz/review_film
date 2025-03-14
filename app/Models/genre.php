<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'genres';
    protected $primaryKey = 'id_genre';
    public $incrementing = true; // Jika id_genre menggunakan AUTO_INCREMENT

    protected $fillable = ['title', 'slug',];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'genre_relations', 'id_genre', 'id_film');
    }
}
