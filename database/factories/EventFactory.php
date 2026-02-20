<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'Laravel Meetup '.fake()->city(),
            'datetime' => fake()->dateTimeBetween('+1 week', '+3 months'),
            'location' => fake()->streetAddress().', '.fake()->city(),
            'description' => fake()->paragraph(),
            'details' => [fake()->paragraph(), fake()->paragraph()],
            'schedule' => [
                ['time' => '17:00', 'activity' => 'Doors open'],
                ['time' => '17:30', 'activity' => 'First talk'],
                ['time' => '18:30', 'activity' => 'Networking'],
            ],
            'footer' => [fake()->paragraph()],
            'organizers' => [
                ['name' => fake()->company(), 'description' => fake()->sentence()],
            ],
            'closing' => fake()->sentence(),
            'link' => null,
        ];
    }

    public function past(): static
    {
        return $this->state(fn (array $attributes) => [
            'datetime' => fake()->dateTimeBetween('-6 months', '-1 day'),
        ]);
    }

    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'datetime' => fake()->dateTimeBetween('+1 day', '+3 months'),
        ]);
    }
}
