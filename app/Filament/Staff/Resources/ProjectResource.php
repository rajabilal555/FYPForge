<?php

namespace App\Filament\Staff\Resources;

use App\Actions\PromoteProject;
use App\Enums\ProjectApprovalStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProjectTerm;
use App\Filament\Staff\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Staff\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Staff\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Staff\Resources\ProjectResource\RelationManagers\FilesRelationManager;
use App\Filament\Staff\Resources\ProjectResource\RelationManagers\StudentRelationManager;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
                    'default' => 1,
                    'md' => 3,
                ])
                    ->schema([
                        Forms\Components\Section::make('Project Details')
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\MarkdownEditor::make('description'),
                            ]),
                        Forms\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([Forms\Components\Section::make()
                                ->columnSpan(1)
                                ->schema([
                                    Forms\Components\TextInput::make('member_limit')
                                        ->type('number')
                                        ->step(1)
                                        ->required(),
                                    Forms\Components\Select::make('status')
                                        ->options(ProjectStatus::class)
                                        ->required(),
                                    Forms\Components\Select::make('approval_status')
                                        ->options(ProjectApprovalStatus::class)
                                        ->required(),
                                    Forms\Components\Select::make('term')
                                        ->options(ProjectTerm::class)
                                        ->required(),
                                ]),
                                Forms\Components\Section::make()
                                    ->columnSpan(1)
                                    ->schema([
                                        Forms\Components\Select::make('evaluation_panel_id')
                                            ->relationship(name: 'evaluation_panel', titleAttribute: 'name')
                                            ->searchable()
                                            ->preload(),
                                        Forms\Components\Select::make('advisor_id')
                                            ->relationship(name: 'advisor', titleAttribute: 'name')
                                            ->searchable()
                                            ->preload(),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->markdown()
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->words(10)
                    ->searchable(),
                Tables\Columns\TextColumn::make('students.name')
                    ->toggleable()
                    ->bulleted(),
                Tables\Columns\TextColumn::make('approval_status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('term')
                    ->badge()
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('evaluation_panel.name')
                    ->placeholder('No Panel')
                    ->words(10)
                    ->sortable(),
                Tables\Columns\TextColumn::make('advisor.name')
                    ->placeholder('No Advisor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_evaluation')
                    ->placeholder('Not Scheduled')
                    ->toggleable()
                    ->html()
                    ->state(function (Project $record) {
                        $event = $record->latestEvaluationEvent();
                        if ($event != null) {
                            return $event->name.'<br>'.$event->pivot->evaluation_date->diffForHumans(short: true, parts: 2);
                        } else {
                            return null;
                        }
                    }),
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
            ])
            ->actions([
                Tables\Actions\Action::make('promote')
                    ->label('Promote')
                    ->icon('heroicon-o-arrow-up-circle')
                    ->modalWidth('sm')
                    ->fillForm(function (Project $record) {
                        return [
                            'term' => $record->term,
                        ];
                    })
                    ->form([
                        Forms\Components\Select::make('term')
                            ->selectablePlaceholder(false)
                            ->options(ProjectTerm::class)
                            ->required(),
                    ])
                    ->action(function (Project $record, array $data) {
                        if ($data['term'] != '') {
                            PromoteProject::make()->handle($record, $data['term']);
                        }
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('promote')
                    ->label('Promote Selected Projects')
                    ->icon('heroicon-o-arrow-up-circle')
                    ->modalWidth('sm')
                    ->form([
                        Forms\Components\Select::make('term')
                            ->placeholder('Select Term')
                            ->options(ProjectTerm::class)
                            ->required(),
                    ])
                    ->action(function (Collection $records, array $data) {
                        foreach ($records as $record) {
                            PromoteProject::make()->handle($record, ProjectTerm::from($data['term']), false);
                        }

                        Notification::make()
                            ->title(count($records).' Projects Promoted')
                            ->body('The selected projects have been promoted')
                            ->success()
                            ->send();

                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StudentRelationManager::class,
            FilesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
