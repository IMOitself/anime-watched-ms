<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animes = Anime::paginate(10);
        return view('animes.index', compact('animes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('animes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anime_id' => 'required|unique:animes,anime_id',
            'name' => 'required',
            'course' => 'required|in:BSIS,BAB,BSAIS,BSSW,BSA',
            'year' => 'required|integer|min:1|max:4',
        ]);

        Anime::create($request->all());

        return redirect()->route('animes.index')->with('success', 'Anime created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anime = Anime::findOrFail($id);
        return view('animes.show', compact('anime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anime = Anime::findOrFail($id);
        return view('animes.edit', compact('anime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'anime_id' => 'required|unique:animes,anime_id,' . $id,
            'name' => 'required',
            'course' => 'required|in:BSIS,BAB,BSAIS,BSSW,BSA',
            'year' => 'required|integer|min:1|max:4',
        ]);

        $anime = Anime::findOrFail($id);
        $anime->update($request->all());

        return redirect()->route('animes.index')->with('success', 'Anime updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anime = Anime::findOrFail($id);
        $anime->delete();

        return redirect()->route('animes.index')->with('success', 'Anime deleted successfully.');
    }
}
