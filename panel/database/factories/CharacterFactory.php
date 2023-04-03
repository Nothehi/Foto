<?php

namespace Database\Factories;

use App\Models\Face;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'face_id' => Face::factory(),
            'key' => str()->uuid(),
            'name' => fake()->name(),
        ];
    }
}
