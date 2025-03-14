<?php

namespace App\Http\Controllers\anonymous;

use App\Http\Controllers\Controller;
use App\Models\film;
use App\Models\genre_relation;
use Illuminate\Http\Request;

class searchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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

        return view('anonymous.search', compact('film', 'genre', 'filmIds'));
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
