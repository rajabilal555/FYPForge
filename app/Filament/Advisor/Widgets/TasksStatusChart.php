<?php

namespace App\Filament\Advisor\Widgets;

use App\Enums\ProjectTaskStatus;
use App\Models\Advisor;
use App\Models\ProjectTask;
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

        $advisorTasks = ProjectTask::query()->whereIn('project_id', Advisor::authUser()->projects->pluck('id'))->get();

        $tasks = $advisorTasks->groupBy('status')->map(function ($tasks, $status) {
            return $tasks->count();
        });

        return [
            'labels' => collect(ProjectTaskStatus::cases())->map(fn ($status) => $status->getLabel())->values()->toArray(),
            'datasets' => [
                [
                    'label' => 'Tasks',
                    'data' => $tasks->values()->toArray(),

                    'backgroundColor' => [
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(12, 84, 163, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
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
