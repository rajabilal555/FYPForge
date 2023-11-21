<?php

namespace App\Filament\Staff\Resources\StudentResource\Pages;

use App\Filament\Staff\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('goto-import-students')
                ->color(Color::Teal)
                ->label('Import Students')
                ->icon('heroicon-o-arrow-up-on-square-stack')
                ->url(StudentResource::getUrl('import')),
            Actions\CreateAction::make(),
        ];
    }
}
