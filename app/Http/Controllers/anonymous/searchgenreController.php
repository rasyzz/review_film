<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\film;
use App\Models\Genre;
use App\Models\genre_relation;
use Illuminate\Http\Request;

class searchgenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::select('films.id_film', 'films.title', 'films.poster', 'films.release_year')
            ->join('genre_relations', 'films.id_film', '=', 'genre_relations.id_film') // Perbaikan di sini
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre') // Perbaikan di sini
            ->where('genre_relations.id_genre', $id) // Perbaikan di sini
            ->groupBy('films.id_film', 'films.title', 'films.poster', 'films.release_year')
            ->get()
            ->map(function ($film) {
                $film->genres = genre_relation::join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre') // Perbaikan di sini
                    ->where('genre_relations.id_film', $film->id_film) // Perbaikan di sini
                    ->pluck('genres.title')
                    ->toArray();
                return $film;
            });
    
        $selectedGenre = Genre::where('id_genre', $id)->value('title');
    
        return view('anonymous.search_genre', compact('genre','films', 'selectedGenre'));
    }
}
