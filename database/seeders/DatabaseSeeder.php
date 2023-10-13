<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Student::factory(200)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test Coordinator',
            'email' => 'test@example.com',
        ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test Student',
            'email' => 'student@example.com'
        ]);
        \App\Models\Advisor::factory()->create([
            'name' => 'Test Advisor',
            'email' => 'advisor@example.com'
        ]);
    }
}
