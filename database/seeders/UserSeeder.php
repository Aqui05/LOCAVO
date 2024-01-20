<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('TestUser')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'kikissagbeaquilas@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('Administrator')
        ]);
    }
}
