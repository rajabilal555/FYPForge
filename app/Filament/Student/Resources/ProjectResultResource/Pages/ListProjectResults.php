<?php

namespace App\Filament\Student\Resources\ProjectResultResource\Pages;

use App\Filament\Student\Resources\ProjectResultResource;
use Filament\Resources\Pages\ListRecords;

class ListProjectResults extends ListRecords
{
    protected static string $resource = ProjectResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
