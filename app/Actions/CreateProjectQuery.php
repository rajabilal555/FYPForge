<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\Student;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class CreateProjectQuery
{
    use Makeable;

    public function handle(Project $project, string $query): void
    {
        $student = Student::find(auth()->id());

        $project->queries()->create([
            'query' => $query,
            'student_id' => $student->id,
        ]);

        //TODO: send advisor a notification

        Notification::make()
            ->title('Query Sent')
            ->success()
            ->send();

    }
}
