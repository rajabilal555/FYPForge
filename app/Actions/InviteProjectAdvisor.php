<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Models\Advisor;
use App\Models\Project;
use App\Models\ProjectAdvisorInvite;
use App\Models\ProjectMemberInvite;
use App\Models\Student;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class InviteProjectAdvisor
{
    use Makeable;
    public function handle(Project $project, $advisorId, $message): void
    {
        $advisor = Advisor::find($advisorId);

        if ($advisor->projects()->count() >= $advisor->slots) {
            Notification::make()
                ->title('Invitation Failed')
                ->body('The advisor you are trying to invite has no slots available.')
                ->danger()
                ->send();
            return;
        }

        if ($project->pendingAdvisorInvites()->count() > 0) {
            Notification::make()
                ->title('Invitation Failed')
                ->body('You Already have a pending Invite, please wait 3 days.')
                ->danger()
                ->send();
            return;
        }

        ProjectAdvisorInvite::updateOrCreate([
            'project_id' => $project->id,
            'advisor_id' => $advisorId,
            'sent_by' => auth()->id(),
        ], [
            'message' => $message,
            'status' => ProjectInviteStatus::Pending,
        ]);

        Notification::make()
            ->title('Invitation Sent')
            ->body('The invitation was sent, you will get a response within 3 days.')
            ->success()
            ->send();
    }
}
