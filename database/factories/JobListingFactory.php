<?php

namespace Database\Factories;

use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'external_id' => (string) fake()->unique()->numerify('41#########'),
            'source' => 'linkedin',
            'search_label' => fake()->randomElement(['Sweden — Laravel', 'Sweden — PHP', 'Copenhagen — Laravel']),
            'title' => fake()->randomElement(['Backend Developer', 'PHP Developer', 'Senior Laravel Engineer']),
            'company_name' => fake()->company(),
            'location' => fake()->randomElement(['Stockholm, Sweden', 'Malmö, Sweden', 'Copenhagen, Denmark']),
            'url' => 'https://www.linkedin.com/jobs/view/'.fake()->unique()->numerify('41#########'),
            'posted_date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'status' => 'pending',
            'admin_notes' => null,
            'company_id' => null,
            'approved_at' => null,
            'posted_to_slack_at' => null,
        ];
    }

    /**
     * Indicate that the job is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'approved_at' => now(),
        ]);
    }

    /**
     * Indicate that the job is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
        ]);
    }
}
