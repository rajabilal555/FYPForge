<?php

namespace App\Filament\Advisor\Widgets;

use App\Enums\ProjectTaskStatus;
use App\Models\Advisor;
use App\Models\ProjectTask;
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

        $tasks = ProjectTask::query()->whereIn('project_id', Advisor::authUser()->projects->pluck('id'))->get();

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
