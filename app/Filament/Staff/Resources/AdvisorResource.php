<?php

namespace App\Filament\Staff\Resources;

use App\Filament\Staff\Resources\AdvisorResource\Pages;
use App\Filament\Staff\Resources\AdvisorResource\RelationManagers;
use App\Models\Advisor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AdvisorResource extends Resource
{
    protected static ?string $model = Advisor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
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
                    ->required(function (string $operation) {
                        return $operation === 'create';
                    })
                    ->hiddenOn('edit')
                    ->maxLength(255),
                Forms\Components\TextInput::make('extra_info')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('field_of_interests')
                    ->wrap()
                    ->label('Fields of Interest'),
                Tables\Columns\TextColumn::make('room_no')
                    ->label('Room No'),
                Tables\Columns\TextColumn::make('available_slots')->counts('projects')
                    ->sortable(['projects_count'])
                    ->state(function (Advisor $record): string {
                        return $record->available_slots . ' / ' . $record->slots;
                    })
                    ->label('Available Slots'),
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
            'index' => Pages\ListAdvisors::route('/'),
            'create' => Pages\CreateAdvisor::route('/create'),
            'edit' => Pages\EditAdvisor::route('/{record}/edit'),
        ];
    }
}
