<?php

namespace App\Actions;

use App\Enums\ProjectInviteStatus;
use App\Filament\Student\Pages\MyProject;
use App\Models\ProjectMemberInvite;
use App\Models\Student;
use App\Traits\Makeable;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class AcceptProjectMemberInvite
{
    use Makeable;

    public function handle(ProjectMemberInvite $invite): void
    {
        $student = Student::find(auth()->id());

        if ($student->project != null) {
            Notification::make()
                ->title('Cannot Accept Invitation')
                ->body('You already have a project.')
                ->danger()
                ->send();

            return;
        }

        // TODO: check if the project is full

        $invite->project->students()->save($student);

        $student->memberInvites()->whereNot('id', $invite->id)->update([
            'status' => ProjectInviteStatus::Rejected,
        ]);

        $invite->update([
            'status' => ProjectInviteStatus::Accepted,
        ]);

        Notification::make()
            ->title('Invitation Accepted')
            ->actions([
                Action::make('goto-project')
                    ->label('Go to Project')
                    ->icon('heroicon-o-link')
                    ->url(MyProject::getUrl()),
            ])
            ->success()
            ->send();

    }
}
