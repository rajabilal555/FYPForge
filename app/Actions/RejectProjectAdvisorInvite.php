<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Models\ProjectAdvisorInvite;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class RejectProjectAdvisorInvite
{
    use Makeable;

    public function handle(ProjectAdvisorInvite $invite): void
    {
        //        $invite->update([
        //            'status' => ProjectInviteStatus::Rejected,
        //        ]);
        $invite->delete();

        Notification::make()
            ->title('Invitation Rejected')
            ->danger()
            ->send();
    }
}
