<?php

namespace Database\Seeders;

use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Models\Advisor;
use App\Models\EvaluationEvent;
use App\Models\EvaluationPanel;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Database\Seeder;

class SampleProject3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testAdvisor = Advisor::where('email', 'advisor@szabist.pk')->first();

        $project = Project::factory()->create([
            'name' => 'Test Project 3',
            'description' => 'Test Project 3 Description',
            'status' => ProjectStatus::InProgress,
            'approval_status' => ProjectApprovalStatus::Approved,
            'term' => ProjectTerm::FYP1,
            'advisor_id' => $testAdvisor->id,
        ]);

        Student::factory()->create([
            'name' => 'Test Student 1P3',
            'email' => 'student13@szabist.pk',
            'project_id' => $project->id,
        ]);

        Student::factory()->create([
            'name' => 'Test Student 2P3',
            'email' => 'student23@szabist.pk',
            'project_id' => $project->id,
        ]);

        $evaluator = EvaluationPanel::where('email', 'evaluator1@szabist.pk')->first();

        $project->update([
            'evaluation_panel_id' => $evaluator->id,
        ]);


        $evaluationEvent = EvaluationEvent::factory()->create([
            'name' => 'Test Evaluation Event 3',
            'start_datetime' => now(),
            'per_project_duration' => 10,
            'total_marks' => 25,
            'is_final_evaluation' => false,
            'shuffle_evaluation_panels' => false,
            'result_generated' => false,
        ]);

        $project->evaluationEvents()->attach($evaluationEvent->id, [
            'evaluation_date' => now()->addDay(),
        ]);

        $project->evaluations()->create([
            'student_id' => $project->students->first()->id,
            'evaluation_event_id' => $evaluationEvent->id,
            'evaluation_panel_id' => $evaluator->id,
            'term' => ProjectTerm::FYP1,
            'marks' => 22,
            'comments' => 'Good work 2',
        ]);

        $project->evaluations()->create([
            'student_id' => $project->students->last()->id,
            'evaluation_event_id' => $evaluationEvent->id,
            'evaluation_panel_id' => $evaluator->id,
            'term' => ProjectTerm::FYP1,
            'marks' => 21,
            'comments' => 'Good work 1',
        ]);


    }
}
