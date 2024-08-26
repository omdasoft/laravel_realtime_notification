<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
         //Create Admin User
         User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => 'admin',
            'isAdmin' => 1
        ]);

        //Create fake users
        User::factory(10)->create();
    }
}
