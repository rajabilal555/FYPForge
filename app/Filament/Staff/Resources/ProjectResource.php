<?php

namespace App\Filament\Staff\Resources;

use App\Enums\ProjectStatus;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('evaluation_panel_id')
                    ->relationship(name: 'evaluation_panel', titleAttribute: 'id')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('advisor_id')
                    ->relationship(name: 'advisor', titleAttribute: 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description'),
                Forms\Components\Select::make('status')
                    ->options(ProjectStatus::class)
                    ->required(),
                Forms\Components\DateTimePicker::make('next_evaluation_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->words(10)
                    ->searchable(),
                Tables\Columns\TextColumn::make('students.name')
                    ->bulleted(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('evaluation_panel.description')
                    ->placeholder('No Panel')
                    ->words(10)
                    ->sortable(),
                Tables\Columns\TextColumn::make('advisor.name')
                    ->placeholder('No Advisor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_evaluation_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Staff\Resources\ProjectResource\Pages\ListProjects::route('/'),
            'create' => \App\Filament\Staff\Resources\ProjectResource\Pages\CreateProject::route('/create'),
            'edit' => \App\Filament\Staff\Resources\ProjectResource\Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
