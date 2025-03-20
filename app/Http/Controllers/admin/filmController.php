<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\genre_relation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start with a base query
        $query = Film::with('genres');
        
        // Apply search filter if provided
        if ($request->has('query') && !empty($request->query)) {
            $searchTerm = $request->query;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('creator', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Apply genre filter if provided
        if ($request->has('genre') && !empty($request->genre)) {
            $genreId = $request->genre;
            $query->whereHas('genres', function($q) use ($genreId) {
                $q->where('genres.id_genre', $genreId);
            });
        }
        
        // Apply year filter if provided
        if ($request->has('year') && !empty($request->year)) {
            $query->where('release_year', $request->year);
        }
        
        // Get the filtered films
        $f = $query->get();
        
        // Ensure we're getting all genres for the dropdown
        $genres = Genre::orderBy('title')->get();
        
        // Get all unique years for the year filter
        $years = Film::select('release_year')
                    ->distinct()
                    ->orderBy('release_year', 'desc')
                    ->pluck('release_year')
                    ->toArray();
        
        return view('admin.film.index', compact('f', 'genres', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.film.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'release_year' => 'required|integer',
            'duration' => 'required|integer',
            'rating' => 'required|integer|min:1|max:10',
            'creator' => 'required|string',
            'kategori_umur' => 'required|string',
            'description' => 'required|string',
            'trailer' => 'nullable|mimes:mp4,mov,avi|max:50000', // Max 50MB
        ]);

        // Beri nilai default null untuk menghindari error jika file tidak diunggah
        $posterPath = null;
        $trailerPath = null;

        // Simpan Poster jika diunggah
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        // Simpan Trailer jika diunggah
        if ($request->hasFile('trailer')) {
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
        }

        // Simpan ke database
        Film::create([
            'title' => $request->title,
            'poster' => $posterPath, // Simpan path lengkap
            'description' => $request->description,
            'release_year' => $request->release_year,
            'duration' => $request->duration,
            'rating' => $request->rating,
            'creator' => $request->creator,
            'kategori_umur' => $request->kategori_umur,
            'trailer' => $trailerPath,
        ]);

        return redirect()->route('film.index')->with('success', 'Film berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    // public function show($id_film)
    // {
    //     $film = Film::findOrFail($id_film);
    //     return view('admin.film.show', compact('film'));
    // }
    public function show($id_film)
    {
        $f1 = Film::with('genres')->findOrFail($id_film);
        $cast = Film::with('castings')->findOrFail($id_film);
        $film = Film::findOrFail($id_film);
        return view('admin.film.show1', compact('film', 'f1', 'cast'));
    }


    public function comment(Film $film)
    {
        // Load relasi comments dan user agar tidak terjadi n+1 problem
        $film->load('comments');
        $film->load('comments.user');
        return view('admin.film.show', compact('film', 'film'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_film)
    {
        $film = Film::findOrFail($id_film);
        return view('admin.film.update', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_film)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'poster'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description'   => 'required|string',
            'release_year'  => 'required|integer',
            'duration'      => 'required|integer',
            'rating'        => 'required|integer|min:1|max:10',
            'creator'       => 'required|string',
            'kategori_umur' => 'nullable|string',
            'trailer'       => 'nullable|mimes:mp4,mov,avi|max:10000',
        ]);

        $film = Film::findOrFail($id_film);

        // Perbarui poster jika file baru diunggah
        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada
            if ($film->poster && Storage::disk('public')->exists($film->poster)) {
                Storage::disk('public')->delete($film->poster);
            }
            // Simpan file poster baru dan simpan path lengkapnya
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->poster = $posterPath;
        }

        // Perbarui trailer jika file baru diunggah
        if ($request->hasFile('trailer')) {
            if ($film->trailer && Storage::disk('public')->exists($film->trailer)) {
                Storage::disk('public')->delete($film->trailer);
            }
            $trailerPath = $request->file('trailer')->store('trailers', 'public');
            $film->trailer = $trailerPath;
        }

        // Perbarui field lainnya
        $film->title = $request->title;
        $film->description = $request->description;
        $film->release_year = $request->release_year;
        $film->duration = $request->duration;
        $film->rating = $request->rating;
        $film->creator = $request->creator;
        $film->kategori_umur = $request->kategori_umur;

        $film->save();

        return redirect()->route('film.index')->with('success', 'Film berhasi di update.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_film)
    {
        $film = Film::findOrFail($id_film);

        // Delete poster if it exists
        if ($film->poster) {
            Storage::delete('public/posters/' . $film->poster);
        }

        // Delete trailer if it exists
        if ($film->trailer) {
            Storage::delete('public/trailers/' . $film->trailer);
        }

        // Delete the film record
        $film->delete();

        return redirect()->route('film.index')->with('success', 'Film berhasil di hapus.');
    }
}
