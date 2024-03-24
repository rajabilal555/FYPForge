<?php

namespace App\Filament\Staff\Resources\ProjectEvaluationResource\Pages;

use App\Filament\Staff\Resources\ProjectEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectEvaluation extends EditRecord
{
    protected static string $resource = ProjectEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
