<?php

namespace App\Filament\Staff\Resources;

use App\Enums\ProjectTerm;
use App\Filament\Staff\Resources\ProjectEvaluationResource\Pages;
use App\Models\ProjectEvaluation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectEvaluationResource extends Resource
{
    protected static ?string $model = ProjectEvaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Evaluation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
                    'default' => 1,
                    'md' => 2,
                ])->schema([
                    Forms\Components\Section::make()
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\Select::make('project_id')
                                ->relationship('project', 'name')
                                ->required(),
                            Forms\Components\Select::make('student_id')
                                ->relationship('student', 'name')
                                ->required(),
                            Forms\Components\Select::make('evaluation_panel_id')
                                ->relationship('evaluationPanel', 'name')
                                ->required(),
                            Forms\Components\Select::make('evaluation_event_id')
                                ->relationship('evaluation_event', 'name')
                                ->required(),
                        ]),

                    Forms\Components\Section::make()
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\Select::make('term')
                                ->options(ProjectTerm::class)
                                ->required(),
                            Forms\Components\TextInput::make('marks')
                                ->numeric(),
                            Forms\Components\Textarea::make('comments')
                                ->required()
                                ->maxLength(255),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'evaluation_event.name',
                'project.name',
                'term',
            ])
            ->defaultGroup('evaluation_event.name')
            ->columns([
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evaluationPanel.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evaluation_event.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('term')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('marks')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('comments')
                    ->searchable(),
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
                Tables\Filters\TernaryFilter::make('is_final')
                    ->label('Final Evaluation')
                    ->placeholder('All')
                    ->trueLabel('Only Final Evaluations')
                    ->falseLabel('Only Non-Final Evaluations'),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProjectEvaluations::route('/'),
            //            'create' => Pages\CreateProjectEvaluation::route('/create'),
            'edit' => Pages\EditProjectEvaluation::route('/{record}/edit'),
        ];
    }
}
