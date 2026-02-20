<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Seed the application's database with sample companies.
     */
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();

        Company::factory()->approved()->count(5)->create(['user_id' => $user->id]);
        Company::factory()->count(3)->create(['user_id' => $user->id]);
        Company::factory()->rejected()->create(['user_id' => $user->id]);
    }
}
