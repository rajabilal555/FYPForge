<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Models\ProjectInvite;
use App\Models\Student;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class InviteProjectMember
{
    use Makeable;
    public function handle($project, array $data): void
    {
        $student = Student::find($data['student_id']);

        if ($student->project != null) {
            Notification::make()
                ->title('Invitation Failed')
                ->body('The student you are trying to invite already has a project.')
                ->danger()
                ->send();
            return;
        }

        ProjectInvite::updateOrCreate([
            'project_id' => $project->id,
            'student_id' => $data['student_id'],
            'sent_by' => auth()->id(),
        ], [
            'message' => $data['message'],
            'status' => ProjectInviteStatus::Pending,
        ]);

        Notification::make()
            ->title('Invitation Sent')
            ->success()
            ->send();
    }
}
