<?php

namespace App\Filament\Staff\Widgets;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Projects Status';

    protected static ?string $maxHeight = '300px';

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        /**
         * @var \Illuminate\Support\Collection $data
         */
        $data = Project::all()->groupBy('status')->map->count();

        return [
            'labels' => $data->keys()->map(fn ($status) => ProjectStatus::from($status)->getLabel()),
            'datasets' => [
                [
                    'label' => 'All Projects Status',
                    'data' => $data->values()->toArray(),
                    'backgroundColor' => [
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
