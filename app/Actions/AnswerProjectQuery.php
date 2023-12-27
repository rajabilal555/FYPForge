<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\ProjectQuery;
use App\Models\Student;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class AnswerProjectQuery
{
    use Makeable;

    public function handle(ProjectQuery $projectQuery, string $answer): void
    {
        $projectQuery->update([
            'answer' => $answer,
        ]);

        Notification::make()
            ->title('Query Answered')
            ->success()
            ->send();
    }
}
