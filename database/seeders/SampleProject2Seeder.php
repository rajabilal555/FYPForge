<?php

namespace Database\Seeders;

use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Database\Seeder;

class SampleProject2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project2 = Project::factory()->create([
            'name' => 'Test Project 2',
            'description' => 'Test Project 2 Description',
            'status' => ProjectStatus::InProgress,
            'approval_status' => ProjectApprovalStatus::Draft,
        ]);

        Student::factory()->create([
            'name' => 'Test Student 3P2',
            'email' => 'student3@szabist.pk',
            'project_id' => $project2->id,
        ]);

    }
}
