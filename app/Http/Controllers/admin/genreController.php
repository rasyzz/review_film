<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class genreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = Genre::all();
        return view('admin.genre.index', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = Genre::all();
        return view('admin.genre.create', compact('genre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'title' => 'required|string|max:255|unique:genres,title',
    ]);

    // Simpan data ke database
    Genre::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title), // Slug otomatis
    ]);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('genre.index')->with('success', 'data berhasil ditambah.');

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
    public function edit($id_genre)
    {
        $genre = Genre::where('id_genre', $id_genre)->firstOrFail();
        return view('admin.genre.update', compact('genre')); // Mengirim data barang dan kategori ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_genre) // Sesuai dengan primary key di model
    {
        $genre = Genre::findOrFail($id_genre); // Gunakan id_genre agar sesuai dengan model
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:genres,slug,'.$id_genre,
        ]);
    
        // Slug hanya dibuat otomatis jika user tidak mengisinya
        $slug = $request->filled('slug') ? $validated['slug'] : Str::slug($validated['title']);
    
        $genre->update([
            'title' => $validated['title'],
            'slug' => $slug,
        ]);
    
        return redirect()->route('genre.index')->with('success', 'Genre updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_genre)
    {
        try {
            $genre = Genre::findOrFail($id_genre); // Menangkap exception jika data tidak ditemukan
            $genre->delete();
            return redirect()->route('genre.index')->with('success', 'Data genre berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('genre.index')->with('error', 'Data genre tidak ditemukan atau terjadi kesalahan.');
        }
    }
}
