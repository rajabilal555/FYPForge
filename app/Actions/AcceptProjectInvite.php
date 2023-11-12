<?php

namespace App\Actions;

use App\Filament\Student\Pages\MyProject;
use App\Models\ProjectInvite;
use App\Models\Student;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class AcceptProjectInvite
{
    public function handle(ProjectInvite $invite): void
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

        $student->invites()->whereNot('id', $invite->id)->update([
            'status' => 'rejected',
        ]);

        $invite->update([
            'status' => 'accepted',
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
