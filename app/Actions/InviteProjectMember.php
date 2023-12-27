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

        $oldRequest = ProjectMemberInvite::where('project_id', $project->id)
            ->where('student_id', $studentId)
            ->first();

        if ($oldRequest != null) {
            Notification::make()
                ->title('Invitation Failed')
                ->body('You cannot invite this student again.')
                ->danger()
                ->send();

            return;
        }

        ProjectMemberInvite::create([
            'project_id' => $project->id,
            'student_id' => $studentId,
            'sent_by' => auth()->id(),
            'message' => $message,
            'status' => ProjectInviteStatus::Pending,
            'expires_at' => now()->addDays(3),
        ]);

        Notification::make()
            ->title('Invitation Sent')
            ->success()
            ->send();
    }
}
