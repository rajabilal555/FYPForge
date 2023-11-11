<?php

namespace App\Filament\Staff\Resources\EvaluationPanelResource\Pages;

use App\Filament\Staff\Resources\EvaluationPanelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvaluationPanel extends EditRecord
{
    protected static string $resource = EvaluationPanelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
