<?php

namespace Database\Factories;

use App\Models\BrideGroom;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BrideGroom>
 */
class BrideGroomFactory extends Factory
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
            'type' => fake()->randomElement(['bride', 'groom']),
            'full_name' => fake()->name(),
            'nickname' => fake()->firstName(),
            'father_name' => fake()->name('male'),
            'mother_name' => fake()->name('female'),
            'instagram_url' => null,
            'photo_path' => null,
            'description' => fake()->sentence(),
        ];
    }
}
