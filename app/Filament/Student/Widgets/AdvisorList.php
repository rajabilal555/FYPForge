<?php

namespace App\Filament\Student\Widgets;

use App\Models\Advisor;
use App\Models\Student;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class AdvisorList extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Advisor::with('projects')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Name'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->wrap()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('field_of_interests')
                    ->searchable()
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->label('Fields of Interest'),
                Tables\Columns\TextColumn::make('room_no')
                    ->label('Room No'),
                Tables\Columns\TextColumn::make('available_slots')
                    ->counts('projects')
                    ->sortable(['projects_count'])
                    ->state(function (Advisor $record): string {
                        return $record->available_slots . ' / ' . $record->slots;
                    })
                    ->label('Available Slots'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('field_of_interests')
                    ->multiple()
                    ->options(fn(): array => Advisor::all()->groupBy('field_of_interests')->keys()->mapWithKeys(fn($value, $key) => [$value => $value])->all())
                    ->query(fn(Builder $query, array $data): Builder => $query->whereJsonContains('field_of_interests', $data['values']))
                    ->label('Fields of Interest'),
            ], Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('invite')
                    ->disabled(fn() => Student::authUser()->project == null)
                    ->icon('heroicon-o-envelope')
                    ->form([
                        Textarea::make('message')
                            ->helperText('Message to send to the advisor')
                    ])
                    ->modalHeading(fn (Advisor $record): string => 'Invite ' . $record->name . ' to your project')
                    ->label('Invite'),
            ]);
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->paginate($this->getTableRecordsPerPage() == 'all' ? $query->count() : $this->getTableRecordsPerPage());
    }
}
