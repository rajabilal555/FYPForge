<?php

namespace App\Filament\Staff\Resources\ProjectEvaluationResource\Pages;

use App\Enums\ProjectTerm;
use App\Filament\Staff\Resources\ProjectEvaluationResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProjectEvaluations extends ListRecords
{
    protected static string $resource = ProjectEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'fyp1' => Tab::make('FYP 1')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('term', ProjectTerm::FYP1)),
            'fyp2' => Tab::make('FYP 2')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('term', ProjectTerm::FYP2)),
        ];
    }
}
