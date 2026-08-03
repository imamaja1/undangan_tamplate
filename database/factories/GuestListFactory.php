<?php

namespace Database\Factories;

use App\Models\GuestList;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GuestList>
 */
class GuestListFactory extends Factory
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
            'phone_number' => fake()->numerify('628##########'),
            'is_sent' => false,
        ];
    }
}
