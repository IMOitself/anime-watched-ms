<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
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
        $randomPage = rand(1, 5);
    
        $response = Http::withoutVerifying()
            ->get("https://api.jikan.moe/v4/top/anime?filter=bypopularity&page={$randomPage}&sfw=true");

        $anime = collect($response->json('data'))->random();
        return view('animes.create', compact('anime'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anime_id' => 'required|unique:animes,anime_id',
            'image_url' => 'required',
            'title' => 'required',
            'score' => 'required',
            'episodes' => 'required',
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
            'anime_id' => 'required',
            'image_url' => 'required',
            'title' => 'required',
            'score' => 'required',
            'episodes' => 'required',
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
