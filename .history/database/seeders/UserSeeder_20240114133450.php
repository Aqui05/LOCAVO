<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'eliseekikissagbe@gmail.com',
            'role' => 'user',
            'password' => 'TestUser'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'kikissagbeaquilas@gmail.com',
            'role' => 'admin',
            'password' => 'Administrator'
        ]);
    }
}
