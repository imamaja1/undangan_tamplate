<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
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
            'type' => 'image',
            'file_path' => 'galleries/images/'.fake()->uuid().'.jpg',
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
