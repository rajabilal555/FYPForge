<?php

namespace App\Filament\Advisor\Widgets;

use App\Actions\AcceptProjectAdvisorInvite;
use App\Actions\RejectProjectAdvisorInvite;
use App\Enums\ProjectInviteStatus;
use App\Models\Advisor;
use App\Models\ProjectAdvisorInvite;
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
                Advisor::authUser()
                    ->pendingProjectInvites()
                    ->with(['project', 'sender'])
                    ->getQuery()
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sender.name'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->formatStateUsing(fn ($record) => $record->created_at->diffForHumans())
                    ->label('Sent at')
                    ->sortable(),
            ])
            ->actions([
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
                            ->hidden(fn (ProjectAdvisorInvite $invite) => $invite->status != ProjectInviteStatus::Pending)
                            ->action(fn (ProjectAdvisorInvite $invite) => AcceptProjectAdvisorInvite::make()->handle($invite)),
                        Tables\Actions\Action::make('rejectFooter')
                            ->label('Reject')
                            ->icon('heroicon-s-x-circle')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->cancelParentActions()
                            ->hidden(fn (ProjectAdvisorInvite $invite) => $invite->status != ProjectInviteStatus::Pending)
                            ->action(fn (ProjectAdvisorInvite $invite) => RejectProjectAdvisorInvite::make()->handle($invite)),
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

            ]);
    }
}
