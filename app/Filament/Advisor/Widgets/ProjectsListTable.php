<?php

namespace App\Filament\Advisor\Widgets;

use App\Filament\Advisor\Resources\MyProjectResource;
use App\Models\Advisor;
use App\Models\Project;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProjectsListTable extends BaseWidget
{
    protected static ?string $heading = 'Projects';

    protected int|string|array $columnSpan = [
        'md' => 1,
        'lg' => 2,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::where('advisor_id', Advisor::authUser()->id)
            )
            ->columns([
                Stack::make([
                    TextColumn::make('name')
                        ->weight(FontWeight::Bold),

                    //TextColumn::make('description')
                    //    ->words(10),

                    TextColumn::make('students.name')
//                      ->prefix('Students: ')
                        ->markdown()
                        ->separator(', <br>'),
                    TextColumn::make('evaluationPanel.description')
                        ->placeholder('No Panel')
                        ->words(10),

                    Split::make([
                        TextColumn::make('approval_status')
                            ->grow(false)
                            ->badge(),
                        TextColumn::make('status')
                            ->grow(false)
                            ->badge(),
                    ])->from('xl'),

                ]),
            ])
            ->recordUrl(
                fn (Project $record) => MyProjectResource::getUrl('view', ['record' => $record])
            )
            ->paginated(false)
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ]);
    }
}
