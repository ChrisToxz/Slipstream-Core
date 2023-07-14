<?php

namespace Database\Factories;

use App\Enums\SlipStatus;
use App\Models\Slip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Slip>
 */
class SlipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token' => Str::random(6),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => SlipStatus::FINISHED,
        ];
    }
}
