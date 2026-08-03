<?php

namespace Database\Factories;

use App\Models\Invitation;
use App\Models\Rsvp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rsvp>
 */
class RsvpFactory extends Factory
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
            'name' => fake()->name(),
            'status' => fake()->randomElement(['attending', 'declined']),
            'pax' => fake()->numberBetween(1, 5),
            'message' => fake()->optional()->sentence(),
        ];
    }
}
