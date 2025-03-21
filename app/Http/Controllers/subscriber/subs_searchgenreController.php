<?php

namespace App\Http\Controllers\subscriber;

use App\Http\Controllers\Controller;
use App\Models\film;
use App\Models\Genre;
use App\Models\genre_relation;
use Illuminate\Http\Request;

class subs_searchgenreController extends Controller
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
    
        return view('subscriber.search_genre', compact('genre','films', 'selectedGenre'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
