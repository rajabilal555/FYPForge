<?php

namespace App\Filament\Student\Widgets;

use App\Actions\AcceptProjectInvite;
use App\Actions\InviteProjectMember;
use App\Models\Project;
use App\Models\ProjectInvite;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProjectInvites extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                auth()->user()->invites()->with('project')->getQuery(),
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project')
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.description')
                    ->wrap()
                    ->label('Description')
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->wrap(),

                Tables\Columns\TextColumn::make('project.status')
                    ->badge()
                    ->label('Status')
                    ->sortable(),
            ])->actions([
                Tables\Actions\Action::make('accept')
                    ->label('Accept')
                    ->icon('heroicon-s-check-circle')
                    ->requiresConfirmation()
                    ->action(fn(ProjectInvite $invite) => app(AcceptProjectInvite::class)->handle($invite)),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-s-x-circle')
                    ->requiresConfirmation()
                    ->action(fn(ProjectInvite $invite) => $invite->delete()),
            ]);
    }
}
