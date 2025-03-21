<?php

namespace App\Http\Controllers\author;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class a_FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::all();
        return view('author.film.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.film.create');
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
            'trailer' => $trailerPath,
        ]);

        return redirect()->route('a.film.index')->with('success', 'Film berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_film)
    {
        $film = Film::findOrFail($id_film);
        return view('author.film.show', compact('film'));
    }


    public function comment(Film $film)
    {
        // Load relasi comments dan user agar tidak terjadi n+1 problem
        $film->load('comments');
        $film->load('comments.user');
        return view('author.film.show', compact('film', 'film'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_film)
    {
        $film = Film::findOrFail($id_film);
        return view('author.film.update', compact('film'));
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

        $film->save();

        return redirect()->route('a.film.index')->with('success', 'Film berhasi di update.');
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

        return redirect()->route('a.film.index')->with('success', 'Film berhasil di hapus.');
    }
}
