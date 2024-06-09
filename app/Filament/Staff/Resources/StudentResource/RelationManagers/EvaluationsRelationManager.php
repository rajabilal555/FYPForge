<?php

namespace App\Filament\Staff\Resources\StudentResource\RelationManagers;

use App\Filament\Staff\Resources\ProjectEvaluationResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluationsRelationManager extends RelationManager
{
    protected static string $relationship = 'evaluations';

    public function table(Table $table): Table
    {
        // merge the table with the ProjectEvaluationResource table
        $resourceTable = ProjectEvaluationResource::table($table);

        return $table
//            ->columns([
//                $resourceTable->getColumn('project.name'),
//            ])
            ->groups(['evaluationPanel.name'])
            ->defaultGroup(null)
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn ($record): string => ProjectEvaluationResource::getUrl('edit', ['record' => $record])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
