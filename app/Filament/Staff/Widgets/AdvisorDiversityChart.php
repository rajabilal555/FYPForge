<?php

namespace App\Filament\Staff\Widgets;

use App\Models\Advisor;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class AdvisorDiversityChart extends ChartWidget
{
    protected static ?string $heading = 'Advisor Diversity';

    protected function getOptions(): array|RawJs|null
    {
        return [
            'indexAxis' => 'y',
        ];
    }

    protected function getData(): array
    {
        /**
         * @var \Illuminate\Support\Collection $data
         */
        $data = Advisor::all()->groupBy('field_of_interests')->map->count();

        return [
            'labels' => $data->keys()->toArray(),
            'datasets' => [
                [
                    'label' => 'Advisors',
                    'data' => $data->values()->toArray(),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
