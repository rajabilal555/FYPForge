<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Models\ProjectMemberInvite;
use App\Traits\Makeable;
use Filament\Notifications\Notification;

class RejectProjectInvite
{
    use Makeable;

    public function handle(ProjectMemberInvite $invite): void
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
