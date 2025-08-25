<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Laravel\Prompts\info;
use function Laravel\Prompts\table;

/**
 * Class UserSeeder
 *
 * Seeds the database with a default user.
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Str::password(16, spaces: false);
        User::factory()->admin()->set('password', Hash::make($password))->create([
            'name' => 'Admin User',
            'email' => 'admin@laravelsweden.org',
            'password' => $password,
        ]);

        info('An admin user has been created with the following credentials:');
        table(
            ['Field', 'Value'],
            [
                ['Email', 'admin@laravelsweden.org'],
                ['Password', $password],
            ]
        );
    }
}
