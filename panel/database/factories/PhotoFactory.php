<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $name = fake()->name(),
            'path' => UploadedFile::fake()->image("{$name}.jpg"),
        ];
    }

    public function storeFile(string $path = 'photos')
    {
        return $this->state(fn (array $attributes) => $attributes['path']->store($path));
    }
}
