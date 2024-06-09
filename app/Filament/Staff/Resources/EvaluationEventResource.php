<?php

namespace App\Filament\Staff\Resources;

use App\Actions\ActivateEvaluationEvent;
use App\Filament\Staff\Resources\EvaluationEventResource\Pages;
use App\Models\EvaluationEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EvaluationEventResource extends Resource
{
    protected static ?string $model = EvaluationEvent::class;

    protected static ?string $navigationIcon = 'heroicon-s-calendar-days';

    protected static ?string $navigationGroup = 'Evaluation';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Forms\Components\Section::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DateTimePicker::make('start_datetime')
                            ->required(),
                        Forms\Components\TextInput::make('per_project_duration')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('total_marks')
                            ->numeric()
                            ->required(),
                    ]),

                Forms\Components\Section::make('Other settings')
                    ->description('Read only')
                    ->compact()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Checkbox::make('is_final_evaluation')
                            ->disabled()
                            ->required(),
                        Forms\Components\Checkbox::make('shuffle_evaluation_panels')
                            ->disabled()
                            ->required(),
                        Forms\Components\Checkbox::make('result_generated')
                            ->disabled()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_datetime')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('per_project_duration')
                    ->suffix(' minutes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_marks')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_final_evaluation')
                    ->label('Final Evaluation')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('shuffle_evaluation_panels')
                    ->label('Shuffled Panels')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('result_generated')
                    ->label('Result Generated')
                    ->boolean()
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
                Tables\Actions\Action::make('deactivate')
                    ->label('Deactivate')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(function ($record) {
                        return $record->active;
                    })
                    ->action(fn ($record) => $record->update(['active' => false])),

                Tables\Actions\Action::make('activate')
                    ->label('Activate')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(function ($record) {
                        return ! $record->active;
                    })
                    ->action(fn ($record) => ActivateEvaluationEvent::make()->handle($record)),

                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->before(function (Tables\Actions\DeleteBulkAction $action, $records) {
                    foreach ($records as $record) {
                        if ($record->active) {
                            Notification::make()
                                ->warning()
                                ->title('Cannot delete active evaluation events.')
                                ->send();

                            $action->halt();
                            //throw new \Exception('Cannot delete active evaluation events.');
                        }
                    }
                }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EvaluationEventResource\RelationManagers\ProjectsRelationManager::class,
            EvaluationEventResource\RelationManagers\EvaluationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvaluationEvents::route('/'),
            'edit' => Pages\EditEvaluationEvent::route('/{record}/edit'),
        ];
    }
}
