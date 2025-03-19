<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\Models\film;
use App\Models\genre_relation;
use Illuminate\Http\Request;

class homeAuthorController extends Controller
{
    public function dashboard() {
        $totalFilms = Film::count();
        $totalrelasi = genre_relation ::count();
        $recentFilms = Film::latest()->take(5)->get();
        return view('author.dashboard', compact('totalFilms','recentFilms'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $f1 = film::latest()    // Mengurutkan berdasarkan created_at DESC
        ->take(3)     // Mengambil 3 data teratas
        ->get();       // Eksekusi query
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all(); // Pakai nama variabel jamak agar tidak membingungkan
        return view('author.home', compact('genre', 'films','f1'));
    }

    public function movies()
    {
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all();
        return view('author.movies', compact('genre','films'));
    }

    public function trailer()
    {
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all();
        return view('author.trailer', compact('genre','films'));
    }

    public function show($id_film)
    {
        $f1 = Film::with('genres')->findOrFail($id_film);
        $cast = Film::with('castings')->findOrFail($id_film);
        $gl = genre_relation::with(['film', 'genre'])
            ->get()
            ->groupBy('film.title');
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $film = Film::findOrFail($id_film);
        return view('author.detail_film', compact('genre', 'film','gl','f1','cast'));
    }
}
