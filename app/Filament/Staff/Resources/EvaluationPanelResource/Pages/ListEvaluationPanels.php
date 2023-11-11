<?php

namespace App\Filament\Staff\Resources\EvaluationPanelResource\Pages;

use App\Filament\Staff\Resources\EvaluationPanelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationPanels extends ListRecords
{
    protected static string $resource = EvaluationPanelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
