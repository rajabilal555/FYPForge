<?php

namespace App\Filament\Student\Widgets;

use App\Actions\AcceptProjectInvite;
use App\Actions\RejectProjectInvite;
use App\Enums\ProjectInviteStatus;
use App\Models\ProjectMemberInvite;
use App\Models\Student;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProjectInvites extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Student::authUser()->memberInvites()->with('project', 'sender')->getQuery(),
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('sender.name')
                    ->wrap()
                    ->label('Sent By'),
                Tables\Columns\TextColumn::make('project.name')
                    ->wrap()
                    ->label('Project'),
                Tables\Columns\TextColumn::make('project.status')
                    ->badge()
                    ->label('Project Status'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])->actions([
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-s-eye')
                    ->modalHeading('Project Invitation')
                    ->modalFooterActions([
                        Tables\Actions\Action::make('acceptFooter')
                            ->label('Accept')
                            ->icon('heroicon-s-check-circle')
                            ->color('success')
                            ->requiresConfirmation()
                            ->cancelParentActions()
                            ->hidden(fn(ProjectMemberInvite $invite) => $invite->status != ProjectInviteStatus::Pending)
                            ->action(fn(ProjectMemberInvite $invite) => AcceptProjectInvite::make()->handle($invite)),
                        Tables\Actions\Action::make('rejectFooter')
                            ->label('Reject')
                            ->icon('heroicon-s-x-circle')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->cancelParentActions()
                            ->hidden(fn(ProjectMemberInvite $invite) => $invite->status != ProjectInviteStatus::Pending)
                            ->action(fn(ProjectMemberInvite $invite) => RejectProjectInvite::make()->handle($invite)),
                    ])
                    ->infolist([
                        Fieldset::make('Sender')
                            ->schema([
                                TextEntry::make('sender.name')
                                    ->label('Name'),
                                TextEntry::make('sender.email')
                                    ->label('Email'),
                                TextEntry::make('message')
                                    ->columnSpan(2)
                                    ->markdown(),
                            ]),
                        Fieldset::make('Project')
                            ->schema([
                                TextEntry::make('project.name')
                                    ->label('Name'),
                                TextEntry::make('project.status')
                                    ->label('Status')
                                    ->badge(),
                                TextEntry::make('project.description')
                                    ->columnSpan(2)
                                    ->markdown()
                                    ->label('Description'),
                            ]),

                    ]),


                Tables\Actions\Action::make('accept')
                    ->label('Accept')
                    ->color('success')
                    ->icon('heroicon-s-check-circle')
                    ->requiresConfirmation()
                    ->hidden(fn(ProjectMemberInvite $invite) => $invite->status != ProjectInviteStatus::Pending)
                    ->action(fn(ProjectMemberInvite $invite) => AcceptProjectInvite::make()->handle($invite)),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-s-x-circle')
                    ->requiresConfirmation()
                    ->hidden(fn(ProjectMemberInvite $invite) => $invite->status != ProjectInviteStatus::Pending)
                    ->action(fn(ProjectMemberInvite $invite) => $invite->delete()),
            ]);
    }
}
