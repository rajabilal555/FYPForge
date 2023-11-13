<?php

namespace App\Filament\Student\Widgets;

use App\Models\Advisor;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

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
                // Tables\Columns\TextColumn::make('project.status')
                //     ->badge()
                //     ->label('Project Status'),
                // Tables\Columns\TextColumn::make('status')
                //     ->badge(),
            ]);
    }
}
