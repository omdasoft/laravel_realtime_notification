<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        //Create Admin User
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => 'admin',
            'isAdmin' => 1,
        ]);

        //Create A User
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => 'user',
            'isAdmin' => 0,
        ]);
    }
}
