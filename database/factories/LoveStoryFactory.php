<?php

namespace Database\Factories;

use App\Models\Invitation;
use App\Models\LoveStory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoveStory>
 */
class LoveStoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invitation_id' => Invitation::factory(),
            'title' => fake()->sentence(3),
            'date' => fake()->date(),
            'description' => fake()->paragraph(),
            'photo_path' => null,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
