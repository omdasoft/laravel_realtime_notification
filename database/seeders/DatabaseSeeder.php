<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Create Admin User
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => 'admin',
            'isAdmin' => 1
        ]);
    }
}
