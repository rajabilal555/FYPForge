<?php

namespace App\Filament\Student\Widgets;

use App\Models\Advisor;
use App\Models\ProjectFile;
use App\Models\Student;
use Carbon\Carbon;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProjectFilesChart extends ChartWidget
{
    protected static ?string $heading = 'Project Files';

    protected function getOptions(): array|RawJs|null
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        $filesTrend = Trend::query(Student::authUser()->project->files()->getQuery())
            ->between(
                start: now()->startOfWeek(),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'labels' => $filesTrend->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('l'))->toArray(),
            'datasets' => [
                [
                    'label' => 'Project Queries',
                    'data' => $filesTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
