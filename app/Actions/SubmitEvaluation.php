<?php

namespace App\Actions;

use App\Models\Project;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class SubmitEvaluation
{
    use Makeable;

    public function handle(Project $project, \Closure $getMarks, \Closure $getRemarks): bool
    {
        foreach ($project->students as $student) {
            if ($getMarks($student->id) === null && $project->is_final_evaluation) {
                Notification::make()
                    ->title('Project Evaluation Submission Failed')
                    ->body('Marks for all students are required')
                    ->danger()
                    ->send();

                return false;
            }
            if ($getRemarks($student->id) === null) {
                Notification::make()
                    ->title('Project Evaluation Submission Failed')
                    ->body('Remarks for all students are required')
                    ->danger()
                    ->send();

                return false;
            }
        }

        foreach ($project->students as $student) {
            $project->evaluations()->create([
                'student_id' => $student->id,
                'evaluation_panel_id' => auth()->id(),
                'term' => $project->term,
                'marks' => $getMarks($student->id),
                'comments' => $getRemarks($student->id) ?? 'No remarks',
                'is_final' => $project->is_final_evaluation,
            ]);
        }

        Notification::make()
            ->title('Project Evaluation Submitted')
            ->success()
            ->send();

        return true;
    }
}
