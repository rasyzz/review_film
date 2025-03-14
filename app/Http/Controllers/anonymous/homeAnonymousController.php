<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\film;
use App\Models\Genre;
use App\Models\genre_relation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeAnonymousController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.home'); // pastikan route dengan nama 'admin.home' sudah ada
                case 'user':
                    return redirect()->route('subscriber.home'); // pastikan route 'subscriber.home' sudah ada
                case 'author':
                    return redirect()->route('author.home'); // pastikan route 'author.home' sudah ada
                default:
                    // jika role tidak dikenali, kembalikan halaman default
                    return view('anonymous.home');
            }
        }

        $f1 = film::latest()    // Mengurutkan berdasarkan created_at DESC
            ->take(3)     // Mengambil 3 data teratas
            ->get();
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();

        $films = film::all();

        // jika belum login, tampilkan halaman default untuk user anonymous
        return view('anonymous.home', compact('genre', 'films', 'f1'));
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $f1 = film::latest()    // Mengurutkan berdasarkan created_at DESC
            ->take(3)     // Mengambil 3 data teratas
            ->get();
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();

        $films = film::with('comments')->get();
       
        return view('anonymous.home', compact('genre', 'films', 'f1'));
    }

    public function movies()
    {
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all();
        return view('anonymous.movies', compact('genre', 'films'));
    }

    public function trailer()
    {
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();
        $films = film::all();
        return view('anonymous.trailer', compact('genre', 'films'));
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

    // public function show($id_film)
    // {
    //     $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
    //         ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
    //         ->groupBy('genre_relations.id_genre', 'genres.title')
    //         ->get();
    //     $film = Film::findOrFail($id_film);
    //     return view('anonymous.detail_film', compact('genre', 'film'));
    // }
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
        return view('anonymous.detail_film', compact('genre', 'film','gl','f1','cast'));
    }

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
