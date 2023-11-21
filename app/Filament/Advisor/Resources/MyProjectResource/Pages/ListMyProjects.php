<?php

namespace App\Filament\Advisor\Resources\MyProjectResource\Pages;

use App\Filament\Advisor\Resources\MyProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyProjects extends ListRecords
{
    protected static string $resource = MyProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //            Actions\CreateAction::make(),
        ];
    }
}
