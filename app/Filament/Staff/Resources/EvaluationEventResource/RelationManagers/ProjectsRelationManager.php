<?php

namespace App\Filament\Staff\Resources\EvaluationEventResource\RelationManagers;

use App\Filament\Staff\Resources\ProjectResource;
use Filament\Forms\Components\DateTimePicker;
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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        DateTimePicker::make('evaluation_date')->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn ($record): string => ProjectResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
