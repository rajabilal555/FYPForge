<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Filament\Advisor\Resources\MyProjectResource;
use App\Models\Advisor;
use App\Models\ProjectAdvisorInvite;
use App\Traits\Makeable;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class AcceptProjectAdvisorInvite
{
    use Makeable;

    public function handle(ProjectAdvisorInvite $invite): void
    {
        $advisor = Advisor::authUser();

        if ($advisor->projects()->count() >= $advisor->slots) {
            Notification::make()
                ->title('Cannot Accept Invitation')
                ->body('You have reached the maximum number of projects you can advise.')
                ->danger()
                ->send();

            return;
        }

        $invite->project->advisor()->associate($advisor)->save();

        $invite->update([
            'status' => ProjectInviteStatus::Accepted,
        ]);

        Notification::make()
            ->title('Invitation Accepted')
            ->actions([
                Action::make('goto-projects')
                    ->label('Go to Projects')
                    ->icon('heroicon-o-link')
                    ->url(MyProjectResource::getUrl('view', ['record' => $invite->project->id])),
            ])
            ->success()
            ->send();

    }
}
