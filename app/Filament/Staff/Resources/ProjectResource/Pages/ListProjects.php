<?php

namespace App\Filament\Staff\Resources\ProjectResource\Pages;

use App\Enums\ProjectTerm;
use App\Filament\Staff\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\IconPosition;
use Illuminate\Database\Eloquent\Builder;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_archived', false)),
            'fyp1' => Tab::make('FYP 1')
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_archived', false)
                    ->where('term', ProjectTerm::FYP1)),
            'fyp2' => Tab::make('FYP 2')
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_archived', false)
                    ->where('term', ProjectTerm::FYP2)),
            'archived' => Tab::make('Archived')
                ->icon('heroicon-o-archive-box')
                ->iconPosition(IconPosition::After)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_archived', true)),
        ];
    }
}
