<?php

namespace App\Filament\Staff\Resources\EvaluationEventResource\Pages;

use App\Filament\Staff\Resources\EvaluationEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvaluationEvent extends EditRecord
{
    protected static string $resource = EvaluationEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }
}
