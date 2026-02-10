<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Staff account
        User::factory()->create([
            'name' => 'Sarah Mitchell',
            'email' => 'staff@dp.com',
            'role' => 'staff',
            'phone' => '01604 760000',
            'password' => bcrypt('password'),
        ]);

        // Customer account
        User::factory()->create([
            'name' => 'James Cooper',
            'email' => 'james@example.com',
            'role' => 'customer',
            'phone' => '07700 123456',
            'password' => bcrypt('password'),
        ]);

        $this->call(EventSeeder::class);
    }
}
