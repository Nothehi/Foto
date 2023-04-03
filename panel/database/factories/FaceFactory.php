<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Face>
 */
class FaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'photo_id' => Photo::factory(),
            'character_id' => Character::factory(),
            'image' => UploadedFile::fake()->image(fake()->name().'.jpg'),
            'coordinate' => [rand(0, 10), rand(0, 10), rand(0, 10), rand(0, 10)],
            'encoding' => $this->generateFakeEncoding(),
        ];
    }

    private function generateFakeEncoding()
    {
        $encoding = [];

        for ($i = 0; $i < 128; $i++) {
            $encoding[] = (-1 + lcg_value() * (abs(1 - (-1))));
        }

        return $encoding;
    }
}
