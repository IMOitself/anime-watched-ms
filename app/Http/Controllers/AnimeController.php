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
    public function create(Request $request)
    {
        $anime = new Anime();
        $apiAnime = null;

        if ($request->has('search')) {
            $response = Http::withoutVerifying()
                ->get("https://api.jikan.moe/v4/anime?q={$request->search}&limit=1");
            $responseJson = $response->json('data');
            if ($responseJson == null) return redirect()->route('animes.create')->with('error', "{$request->search} not found.");

            $apiAnime = $responseJson[0];
        }
        // roll random anime
        else {
            $randomPage = rand(1, 5);
            $response = Http::withoutVerifying()
                ->get("https://api.jikan.moe/v4/top/anime?filter=bypopularity&page={$randomPage}&sfw=true");
            $apiAnime = collect($response->json('data'))->random();
        }

        $anime->mal_id = $apiAnime['mal_id'];
        $anime->image_url = $apiAnime['images']['jpg']['large_image_url'] ?? 'not available';
        $anime->title = $apiAnime['title_english'] ?? $apiAnime['title'] ?? 'Unknown';
        $anime->score = $apiAnime['score'] ?? 0;
        $anime->episodes = $apiAnime['episodes'] ?? 0;
        return view('animes.create', compact('anime'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mal_id' => 'required',
            'image_url' => 'required',
            'title' => 'required',
            'score' => 'required',
            'episodes' => 'required',
        ]);

        Anime::create($request->all());

        return redirect()->route('animes.index')->with('success', 'Anime added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anime = Anime::findOrFail($id);
        return view('animes.show', compact('anime'));
    }

    public function edit(Request $request, string $id)
    {
        $anime = Anime::findOrFail($id);
        $apiAnime = null;

        if ($request->has('search')) {
            $response = Http::withoutVerifying()
                ->get("https://api.jikan.moe/v4/anime?q={$request->search}&limit=1");
            $responseJson = $response->json('data');
            if ($responseJson == null) return redirect()->route('animes.edit', $anime->id)->with('error', "{$request->search} not found.");

            $apiAnime = $responseJson[0];
        }
        else
        if ($request->has('roll')) {
            $randomPage = rand(1, 5);
            $response = Http::withoutVerifying()
                ->get("https://api.jikan.moe/v4/top/anime?filter=bypopularity&page={$randomPage}&sfw=true");
            $apiAnime = collect($response->json('data'))->random();
        }

        if ($request->has('search') || $request->has('roll')) {
            $anime->mal_id = $apiAnime['mal_id'];
            $anime->image_url = $apiAnime['images']['jpg']['large_image_url'] ?? 'not available';
            $anime->title = $apiAnime['title_english'] ?? $apiAnime['title'] ?? 'Unknown';
            $anime->score = $apiAnime['score'] ?? 0;
            $anime->episodes = $apiAnime['episodes'] ?? 0;
        }

        return view('animes.edit', compact('anime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'mal_id' => 'required',
            'image_url' => 'required',
            'title' => 'required',
            'score' => 'required',
            'episodes' => 'required',
        ]);

        $anime = Anime::findOrFail($id);
        $anime->update($request->all());

        return redirect()->route('animes.index')->with('success', 'Anime changed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anime = Anime::findOrFail($id);
        $anime->delete();

        return redirect()->route('animes.index')->with('success', 'Anime removed successfully.');
    }
}
