<?php

namespace App\Filament\Staff\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'projectResults';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('total_marks')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_marks_obtained')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('total_marks'),
                Tables\Columns\TextColumn::make('total_marks_obtained'),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
