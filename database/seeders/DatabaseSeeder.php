<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Advisor;
use App\Models\EvaluationPanel;
use App\Models\Project;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the Coordinator/Admin user
        User::factory()->create([
            'name' => 'Coordinator',
            'email' => 'coordinator@szabist.pk',
            'role' => 'admin',
        ]);

        $this->call([
            SampleProjectSeeder::class,
            SampleProject2Seeder::class,
            SampleProject3Seeder::class,
            RealAdvisorsSeeder::class,
        ]);

        EvaluationPanel::factory()->create([
            'name' => 'Test Evaluator 2',
            'email' => 'evaluator2@szabist.pk',
            'description' => 'Test Evaluators for evaluation of Test Projects.',
        ]);

        EvaluationPanel::factory()->create([
            'name' => 'Test Evaluator 3',
            'email' => 'evaluator3@szabist.pk',
            'description' => 'Test Evaluators for evaluation of Test Projects.',
        ]);

        // Sample bulk auto generated data
        Student::factory(100)->create();
        Advisor::factory(20)->create();
        Project::factory(10)->create();
    }
}
