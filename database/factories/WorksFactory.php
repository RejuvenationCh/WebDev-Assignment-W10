<?php

namespace Database\Factories;

use App\Models\Works;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Works>
 */
class WorksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'subtitle' => fake()->sentence(),
            'content' => fake()->paragraphs(4, true),
            'image_path' => null,
            'project_url' => fake()->optional()->url(),
            'is_published' => fake()->boolean(67),
            'is_featured' => fake()->boolean(23),
        ];
    }
}
