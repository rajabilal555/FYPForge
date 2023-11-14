<?php

namespace App\Filament\Student\Widgets;

use App\Models\Advisor;
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
                Advisor::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->wrap()
                    ->label('Name'),
                Tables\Columns\TextColumn::make('email')
                    ->wrap()
                    ->label('Email'),
                Tables\Columns\TextColumn::make('field_of_interests')
                    ->wrap()
                    ->label('Fields'),
                Tables\Columns\TextColumn::make('room_no')
                    ->wrap()
                    ->label('Room No'),
                Tables\Columns\TextColumn::make('slots')
                    ->wrap()
                    ->label('Slots')
            ]);
    }

    protected function paginateTableQuery(Builder $query): Paginator
    {
        return $query->paginate($this->getTableRecordsPerPage() == 'all' ? $query->count() : $this->getTableRecordsPerPage());
    }
}
