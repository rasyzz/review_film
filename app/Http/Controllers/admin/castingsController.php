<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\castings;
use App\Models\film;
use Illuminate\Http\Request;

class castingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $c = castings::with('film')->get();
        return view('admin.castings.index' , compact( 'c'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $films = film::all();
        return view('admin.castings.create' , compact('films'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stage_name' => 'required|string|max:255',
            'real_name' => 'required|string|max:255',
            'id_film' => 'required|exists:films,id_film',
        ]);

        Castings::create($request->all());

        return redirect()->route('castings.index')->with('success', 'Casting berhasil ditambahkan.');
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
    public function edit($id_castings)
    {
        $casting = Castings::findOrFail($id_castings);
        $films = Film::all(); // Ambil semua film untuk dropdown
        return view('admin.castings.update', compact('casting', 'films'));
    }

    /**
     * Memperbarui data casting.
     */
    public function update(Request $request, $id_castings)
    {
        $request->validate([
            'stage_name' => 'required|string|max:255',
            'real_name' => 'required|string|max:255',
            'id_film' => 'required|exists:films,id_film',
        ]);

        $casting = Castings::findOrFail($id_castings);
        $casting->update([
            'stage_name' => $request->stage_name,
            'real_name' => $request->real_name,
            'id_film' => $request->id_film,
        ]);

        return redirect()->route('castings.index')->with('success', 'Data casting berhasil diperbarui.');
    }

    /**
     * Menghapus data casting.
     */
    public function destroy(Castings $id_castings)
    {
        $id_castings->delete();
        return redirect()->route('castings.index')->with('success', 'Casting berhasil dihapus.');
    }
}
