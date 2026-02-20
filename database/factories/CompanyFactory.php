<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
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
            'name' => fake()->company(),
            'city' => fake()->randomElement(['Stockholm', 'Malmö', 'Gothenburg']),
            'website' => fake()->optional()->url(),
            'industry' => fake()->optional()->randomElement(['SaaS', 'E-commerce', 'Consulting', 'FinTech', 'HealthTech']),
            'size' => fake()->optional()->randomElement(Company::SIZES),
            'description' => fake()->optional()->paragraph(),
            'contact_email' => fake()->optional()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'address' => fake()->optional()->address(),
            'logo_path' => null,
            'linkedin' => fake()->optional()->url(),
            'github' => fake()->optional()->url(),
            'twitter' => fake()->optional()->url(),
            'status' => 'pending',
            'admin_notes' => null,
            'submitter_relationship' => fake()->randomElement(Company::SUBMITTER_RELATIONSHIPS),
            'is_sponsor' => false,
        ];
    }

    /**
     * Indicate that the company is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
        ]);
    }

    /**
     * Indicate that the company is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }

    /**
     * Indicate that the company is a sponsor.
     */
    public function sponsor(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_sponsor' => true,
        ]);
    }
}
