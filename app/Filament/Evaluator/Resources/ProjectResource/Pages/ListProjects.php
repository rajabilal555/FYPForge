<?php

namespace App\Filament\Evaluator\Resources\ProjectResource\Pages;

use App\Enums\ProjectTerm;
use App\Filament\Evaluator\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
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
}
