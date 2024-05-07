<?php

namespace App\Filament\Evaluator\Resources;

use App\Filament\Evaluator\Resources\ProjectResource\Pages;
use App\Models\EvaluationEvent;
use App\Models\Project;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canAccess(): bool
    {
        abort_if(! EvaluationEvent::getActiveEvaluationEvent(), 403, 'No Ongoing Active evaluation event.');

        return EvaluationEvent::getActiveEvaluationEvent() != null;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->where('evaluation_panel_id', auth()->id())
                ->whereIn('id', EvaluationEvent::getActiveEvaluationEvent()->projects()->pluck('id'))
            )
            ->columns([
                Tables\Columns\IconColumn::make('submitted')
                    ->boolean()
                    ->state(fn (Project $project) => $project->hasCurrentEvaluation()),
                Tables\Columns\TextColumn::make('evaluation_panel.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('advisor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('approval_status')
                    ->badge()
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'view' => Pages\ViewProject::route('/{record}'),
        ];
    }
}
