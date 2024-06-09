<?php

namespace Database\Seeders;

use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Models\Advisor;
use App\Models\EvaluationPanel;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Database\Seeder;

class SampleProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testAdvisor = Advisor::factory()->create([
            'name' => 'Test Advisor',
            'email' => 'advisor@szabist.pk',
            'room_no' => '404 A',
            'field_of_interests' => ['Web Development', 'Android Development', 'Artificial Intelligence'],
        ]);

        $project1 = Project::factory()->create([
            'name' => 'Test Project 1',
            'description' => 'Test Project 1 Description',
            'status' => ProjectStatus::InProgress,
            'approval_status' => ProjectApprovalStatus::Approved,
            'term' => ProjectTerm::FYP1,
            'advisor_id' => $testAdvisor->id,
        ]);

        Student::factory()->create([
            'name' => 'Test Student 1P1',
            'email' => 'student1@szabist.pk',
            'project_id' => $project1->id,
        ]);

        Student::factory()->create([
            'name' => 'Test Student 2P1',
            'email' => 'student2@szabist.pk',
            'project_id' => $project1->id,
        ]);

        $evaluator = EvaluationPanel::factory()->create([
            'name' => 'Test Evaluator',
            'email' => 'evaluator1@szabist.pk',
            'description' => 'Test Evaluators for evaluation of Test Projects.',
        ]);

        $project1->update([
            'evaluation_panel_id' => $evaluator->id,
        ]);
    }
}
