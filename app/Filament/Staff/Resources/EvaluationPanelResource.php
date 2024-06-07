<?php

namespace App\Filament\Staff\Resources;

use App\Filament\Staff\Resources\EvaluationPanelResource\Pages;
use App\Models\EvaluationPanel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EvaluationPanelResource extends Resource
{
    protected static ?string $model = EvaluationPanel::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('password')
                                ->password()
                                ->required(fn (string $operation): bool => $operation === 'create')
                                ->dehydrated(fn ($state) => filled($state))
                                ->autocomplete('new-password')
                                ->maxLength(255),
                        ]),
                    Forms\Components\Section::make()
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\Checkbox::make('is_active')
                                ->default(false)
                                ->columnSpanFull(),

                            Forms\Components\Textarea::make('description')
                                ->required()
                                ->maxLength(65535)
                                ->rows(10)
                                ->columnSpanFull(),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_active')
                    ->alignCenter()
                    ->tooltip(fn (EvaluationPanel $record) => $record->is_active ? 'Login enabled' : 'Login disabled')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->wrap()
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //                Tables\Actions\DeleteBulkAction::make(),

                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('activate_panel')
                        ->color('success')
                        ->label('Activate')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),

                    Tables\Actions\BulkAction::make('deactivate_panel')
                        ->color('danger')
                        ->label('Deactivate')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                ])
                    ->label('Activate/Deactivate')
                    ->icon('heroicon-o-play-circle'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EvaluationPanelResource\RelationManagers\ProjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvaluationPanels::route('/'),
            'create' => Pages\CreateEvaluationPanel::route('/create'),
            'edit' => Pages\EditEvaluationPanel::route('/{record}/edit'),
        ];
    }
}
