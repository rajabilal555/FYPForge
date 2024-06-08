<?php

namespace App\Filament\Student\Widgets;

use App\Enums\ProjectTaskStatus;
use App\Models\Student;
use Filament\Support\Colors\Color;
use Filament\Widgets\ChartWidget;

class TasksStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Tasks Status';

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
        $tasks = Student::authUser()->project->tasks;

        $tasks = collect(ProjectTaskStatus::cases())->mapWithKeys(function ($status) use ($tasks) {
            return [$status->value => $tasks->where('status', $status)->count()];
        });

        return [
            'labels' => $tasks->keys()->map(fn ($status) => ProjectTaskStatus::from($status)->getLabel())->values()->toArray(),
            'datasets' => [
                [
                    'label' => 'Tasks',
                    'data' => $tasks->values()->toArray(),
                    'backgroundColor' => [
                        'rgba('.Color::Gray[500].', 0.7)',
                        'rgba('.Color::Red[500].', 0.7)',
                        'rgba('.Color::Green[500].', 0.7)',
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
