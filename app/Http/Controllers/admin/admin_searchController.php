<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\film;
use App\Models\genre_relation;
use Illuminate\Http\Request;

class admin_searchController extends Controller
{
    public function search(Request $request)
    {
        // Ambil kata kunci pencarian dari request (pastikan input name="search" di form)
        $search = $request->input('search');
                // Ambil ID film yang ditemukan
         // Ambil film berdasarkan pencarian judul
         $film = Film::where('title', 'LIKE', "%{$search}%")->get();
    
         // Ambil ID film yang ditemukan
         $filmIds = $film->pluck('id_film');



        // Ambil daftar genre unik yang tersedia
        $genre = genre_relation::select('genre_relations.id_genre', 'genres.title')
            ->join('genres', 'genre_relations.id_genre', '=', 'genres.id_genre')
            ->groupBy('genre_relations.id_genre', 'genres.title')
            ->get();

        return view('admin.search', compact('film', 'genre', 'filmIds'));
    }
    
}
