<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Models\Advisor;
use App\Models\Project;
use App\Models\ProjectAdvisorInvite;
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

        if ($project->advisor()->exists()) {
            Notification::make()
                ->title('Invitation Failed')
                ->body('The project already has an advisor.')
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

        $oldRequest = ProjectAdvisorInvite::where('project_id', $project->id)
            ->where('advisor_id', $advisorId)
            ->first();

        if ($oldRequest != null) {
            Notification::make()
                ->title('Invitation Failed')
                ->body('You cannot invite this advisor again.')
                ->danger()
                ->send();

            return;
        }

        ProjectAdvisorInvite::create([
            'project_id' => $project->id,
            'advisor_id' => $advisorId,
            'sent_by' => auth()->id(),
            'message' => $message,
            'status' => ProjectInviteStatus::Pending,
            'expires_at' => now()->addDays(3),
        ]);

        Notification::make()
            ->title('Invitation Sent')
            ->body('The invitation was sent, you will get a response within 3 days.')
            ->success()
            ->send();

    }
}
