<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\ProjectResultResource\Pages;
use App\Models\ProjectResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResultResource extends Resource
{
    protected static ?string $model = ProjectResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required(),
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Forms\Components\TextInput::make('evaluation_event_ids')
                    ->required(),
                Forms\Components\TextInput::make('total_marks')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_marks_obtained')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('marks_breakdown_data')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
//            only student can see his/her project results
            ->modifyQueryUsing(function ($query) {
                return $query->where('student_id', auth()->id());
            })
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_marks')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_marks_obtained')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectResults::route('/'),
        ];
    }
}
