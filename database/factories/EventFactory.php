<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
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
            'type' => fake()->randomElement(['akad', 'resepsi', 'other']),
            'title' => fake()->sentence(2),
            'event_date' => fake()->date(),
            'start_time' => fake()->time('H:i'),
            'end_time' => null,
            'location_name' => fake()->company(),
            'location_address' => fake()->address(),
            'google_maps_url' => null,
            'is_main_event' => false,
        ];
    }
}
