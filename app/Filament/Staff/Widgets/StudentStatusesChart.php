<?php

namespace App\Filament\Staff\Widgets;

use Filament\Widgets\ChartWidget;

class StudentStatusesChart extends ChartWidget
{
    protected static ?string $heading = 'Student Project Assignment Statuses';

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
        $studentInProject = \App\Models\Student::where('project_id', '!=', null)->count();
        $studentNotInProject = \App\Models\Student::where('project_id', null)->count();

        return [
            'labels' => ['In Project', 'Not In Project'],
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => [$studentInProject, $studentNotInProject],
                    'backgroundColor' => [
                        'rgba(12, 84, 163, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
