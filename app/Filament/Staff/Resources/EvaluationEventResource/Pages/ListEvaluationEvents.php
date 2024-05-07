<?php

namespace App\Filament\Staff\Resources\EvaluationEventResource\Pages;

use App\Filament\Staff\Resources\EvaluationEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluationEvents extends ListRecords
{
    protected static string $resource = EvaluationEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
