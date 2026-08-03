<?php

namespace Database\Factories;

use App\Models\Gift;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gift>
 */
class GiftFactory extends Factory
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
            'provider_name' => fake()->randomElement(['BCA', 'Mandiri', 'BRI', 'OVO', 'DANA']),
            'account_number' => fake()->numerify('#######'),
            'account_name' => fake()->name(),
            'qr_code_path' => null,
        ];
    }
}
