<?php

namespace Database\Factories;

use App\Models\Link;
use App\Services\UniqueLinkGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'original_link' => fake()->url(),
            'life_seconds' => fake()->numberBetween(0, Link::MAX_LIFE_TIME),
            'redirects_count' => fake()->numberBetween(1),
            'is_infinity' => 0,
            'short_link' => UniqueLinkGenerator::generate(),
        ];
    }
}
