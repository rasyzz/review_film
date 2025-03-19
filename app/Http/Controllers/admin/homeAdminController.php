<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Castings;
use App\Models\comment;
use App\Models\film;
use App\Models\Genre;
use App\Models\genre_relation;
use App\Models\User;
use Illuminate\Http\Request;

class homeAdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalFilms = Film::count();
        $totalGenres = Genre::count();
        $totalCastings = Castings::count();
        $recentFilms = Film::latest()->take(5)->get();
       
        $comments = Comment::orderBy('rating', 'desc')->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalFilms',
            'totalGenres',
            'totalCastings',
            'recentFilms',
            'comments'
        ));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $f1 = film::latest()    // Mengurutkan berdasarkan created_at DESC
            ->take(3)     // Mengambil 3 data teratas
            ->get();       // Eksekusi query
        $f2 = film::latest()    // Mengurutkan berdasarkan created_at DESC
            ->take(5)     // Mengambil 3 data teratas
            ->get();       // Eksekusi query
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all(); // Pakai nama variabel jamak agar tidak membingungkan
        return view('admin.home', compact('genre', 'films', 'f1','f2'));
    }

    public function movies()
    {
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all();
        return view('admin.movies', compact('genre', 'films'));
    }

    public function trailer()
    {
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all();
        return view('admin.trailer', compact('genre', 'films'));
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
        return view('admin.detail_film', compact('genre', 'film', 'gl', 'f1', 'cast'));
    }
}
