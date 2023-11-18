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
use Illuminate\Support\Facades\DB;

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
                Forms\Components\TextInput::make('slots')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(15),

                Forms\Components\Select::make('field_of_interests')
                    ->options(fn(): array => Advisor::all()->groupBy('field_of_interests')->keys()->mapWithKeys(fn($value, $key) => [$value => $value])->all())
                    ->multiple()
                    ->required(),

                Forms\Components\TextInput::make('room_no')
                    ->required()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query): Builder {
                return $query->addSelect('*')
                    ->addSelect(DB::raw('slots-(SELECT COUNT(*) FROM projects WHERE projects.advisor_id = advisors.id) as projects_count'));
            })
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
                Tables\Columns\TextColumn::make('available_slots')
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
