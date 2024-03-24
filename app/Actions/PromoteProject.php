<?php

namespace App\Actions;

use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Models\Project;
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

        if ($showNotification) {
            Notification::make()
                ->title('Project Promoted')
                ->success()
                ->send();
        }
    }
}
