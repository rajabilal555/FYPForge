<?php

namespace App\Actions;

use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Models\Project;
use App\Models\Student;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class PromoteProject
{
    use Makeable;

    public function handle(Project $project, ProjectTerm $term, bool $showNotification = true): void
    {
        $project->update([
            'term' => $term,
            'status' => ProjectStatus::InProgress,
        ]);

        $project->students()->each(function (Student $student) {
            $student->notify(
                Notification::make()
                    ->title('Project Promoted')
                    ->body('Your project has been promoted to the next term.')
                    ->toDatabase(),
            );
        });

        if ($showNotification) {
            Notification::make()
                ->title('Project Promoted')
                ->success()
                ->send();
        }
    }
}
