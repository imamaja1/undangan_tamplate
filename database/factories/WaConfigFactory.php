<?php

namespace Database\Factories;

use App\Models\Invitation;
use App\Models\WaConfig;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WaConfig>
 */
class WaConfigFactory extends Factory
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
            'provider' => 'fonnte',
            'api_key' => null,
            'message_template' => fake()->sentence(),
        ];
    }
}
