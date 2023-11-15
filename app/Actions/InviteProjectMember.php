<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Models\ProjectMemberInvite;
use App\Models\Student;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class InviteProjectMember
{
    use Makeable;
    public function handle($project, $studentId, $message): void
    {
        $student = Student::find($studentId);

        if ($student->project != null) {
            Notification::make()
                ->title('Invitation Failed')
                ->body('The student you are trying to invite already has a project.')
                ->danger()
                ->send();
            return;
        }

        ProjectMemberInvite::updateOrCreate([
            'project_id' => $project->id,
            'student_id' => $studentId,
            'sent_by' => auth()->id(),
        ], [
            'message' => $message,
            'status' => ProjectInviteStatus::Pending,
        ]);

        Notification::make()
            ->title('Invitation Sent')
            ->success()
            ->send();
    }
}
