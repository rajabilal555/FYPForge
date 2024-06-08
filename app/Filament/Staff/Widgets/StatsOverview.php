<?php

namespace App\Filament\Staff\Widgets;

use App\Models\Advisor;
use App\Models\EvaluationEvent;
use App\Models\Project;
use App\Models\Student;
use App\Traits\CanFormat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StatsOverview extends BaseWidget
{
    use CanFormat;

    protected int|string|array $columnSpan = 2;

    protected function getStats(): array
    {

        $projectCount = \App\Models\Project::count();
        $advisorCount = \App\Models\Advisor::count();
        $evaluationEventCount = \App\Models\EvaluationEvent::count();
        $studentCount = \App\Models\Student::count();

        $projectTrend = Trend::model(Project::class)
            ->between(
                start: now()->startOfYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        $advisorTrend = Trend::model(Advisor::class)
            ->between(
                start: now()->startOfYear(),
                end: now(),
            )
            ->perMonth()
            ->count();
        $evaluationEventTrend = Trend::model(EvaluationEvent::class)
            ->between(
                start: now()->startOfYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        $studentsTrend = Trend::model(Student::class)
            ->between(
                start: now()->startOfYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            Stat::make('Projects', $this->formatNumber($projectCount))
                ->chart($projectTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color('success'),

            Stat::make('Advisors', $this->formatNumber($projectCount))
                ->chart($advisorTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color('info'),

            Stat::make('Students', $this->formatNumber($studentCount))
                ->chart($studentsTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color('warning'),

            Stat::make('Evaluation Events', $this->formatNumber($evaluationEventCount))
                ->chart($evaluationEventTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
                ->color('danger'),

        ];
    }
}
