<?php

namespace App\Http\Controllers\author;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\film;
use Illuminate\Http\Request;

class a_commentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Film $film)
    {
        // Pastikan user telah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Validasi input
        $validated = $request->validate([
            'rating'   => 'required|in:1,2,3,4,5',
            'komentar' => 'required|string',
        ]);

        // Periksa apakah user sudah berkomentar untuk film ini
        $existingComment = Comment::where('id_user', Auth::id())
            ->where('id_film', $film->id_film)
            ->first();

        if ($existingComment) {
            return redirect()->back()->with('error', 'Anda sudah berkomentar untuk film ini.');
        }

        // Simpan komentar baru
        Comment::create([
            'rating'  => $validated['rating'],
            'comment' => $validated['komentar'],
            'id_user' => Auth::id(),
            'id_film' => $film->id_film,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id) {}

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
    public function update(Request $request, Comment $comment)
    {
        // Pastikan user telah login dan hanya pemilik komentar yang dapat mengubahnya
        if (!Auth::check() || Auth::id() !== $comment->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah komentar ini.');
        }

        // Validasi input dari form edit komentar
        $validated = $request->validate([
            'rating'   => 'required|in:1,2,3,4,5',
            'komentar' => 'required|string',
        ]);

        // Update data komentar
        $comment->update([
            'rating'  => $validated['rating'],
            'comment' => $validated['komentar'],
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui.');
    }

    public function destroy(Comment $comment)
    {
        // Pastikan user telah login dan hanya pemilik komentar yang dapat menghapus komentar ini
        if (!Auth::check() || Auth::id() !== $comment->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
