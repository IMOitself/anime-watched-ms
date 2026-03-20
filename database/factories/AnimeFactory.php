<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomPage = rand(1, 5);
    
        $response = Http::withoutVerifying()
            ->get("https://api.jikan.moe/v4/top/anime?filter=bypopularity&page={$randomPage}&sfw=true");

        $anime = collect($response->json('data'))->random();
        return [
            'mal_id' => $anime['mal_id'],
            'image_url' => $anime['images']['jpg']['large_image_url'],
            'title' => $anime['title_english'],
            'score' => $anime['score'],
            'episodes' => $anime['episodes'],
        ];
    }
}
