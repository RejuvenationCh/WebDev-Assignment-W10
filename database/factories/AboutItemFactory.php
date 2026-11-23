<?php

namespace Database\Factories;

use App\Models\About;
use App\Models\AboutItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AboutItem>
 */
class AboutItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'about_id' => About::factory(),
            'title' => fake()->words(3, true),
            'description' => fake()->paragraph(),
        ];
    }
}
