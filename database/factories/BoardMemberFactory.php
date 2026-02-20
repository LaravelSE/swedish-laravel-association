<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardMember>
 */
class BoardMemberFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->randomElement(['Ordförande', 'Sekreterare', 'Kassör', 'Styrelseledamot', 'Revisor', 'Suppleant']),
            'company' => fake()->company(),
            'image_path' => null,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
