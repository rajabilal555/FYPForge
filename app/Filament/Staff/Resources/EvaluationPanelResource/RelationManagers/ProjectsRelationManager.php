<?php

namespace App\Filament\Staff\Resources\EvaluationPanelResource\RelationManagers;

use App\Filament\Staff\Resources\ProjectResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    public function table(Table $table): Table
    {
        $resourceTable = ProjectResource::table($table);

        return $table
            ->recordTitleAttribute('name')
            ->columns([
                $resourceTable->getColumn('name'),
                $resourceTable->getColumn('description'),
                $resourceTable->getColumn('term'),
                $resourceTable->getColumn('status'),
                $resourceTable->getColumn('approval_status'),
                $resourceTable->getColumn('next_evaluation'),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn ($record): string => ProjectResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([]);
    }
}
