<?php

namespace Database\Factories;

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
        return [
            'anime_id' => $this->faker->unique()->numerify('S-####'),
            'name' => $this->faker->name(),
            'course' => $this->faker->randomElement(['BSIS', 'BAB', 'BSAIS', 'BSSW', 'BSA']),
            'year' => $this->faker->numberBetween(1, 4),
        ];
    }
}
