<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Talk>
 */
class TalkFactory extends Factory
{
    /**
     * Available cities for meetups.
     *
     * @var list<string>
     */
    public const CITIES = ['Stockholm', 'Malmö', 'Gothenburg'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraphs(3, true),
            'cities' => fake()->randomElements(self::CITIES, fake()->numberBetween(1, 3)),
            'position' => fake()->jobTitle(),
            'company' => fake()->optional()->company(),
            'twitter' => fake()->optional()->url(),
            'linkedin' => fake()->optional()->url(),
            'github' => fake()->optional()->url(),
            'bluesky' => fake()->optional()->url(),
            'facebook' => fake()->optional()->url(),
            'instagram' => fake()->optional()->url(),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}
