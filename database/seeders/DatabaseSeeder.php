<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Student::factory(100)->create();

        $project = \App\Models\Project::factory()->create([
            'name' => 'Test Project 1',
            'description' => 'Test Project 1 Description',
            'status' => 'Finding Advisor',
        ]);

        \App\Models\Project::factory()->create([
            'name' => 'Test Project 2',
            'description' => 'Test Project 2 Description',
            'status' => 'Finding Advisor',
        ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test Student 1',
            'email' => 'student1@example.com',
            'project_id' => $project->id,
        ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test Student 2',
            'email' => 'student2@example.com',
            'project_id' => $project->id,
        ]);

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
