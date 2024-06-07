<?php

namespace App\Filament\Staff\Widgets;

use App\Models\Advisor;
use Filament\Widgets\ChartWidget;

class AdvisorDiversityChart extends ChartWidget
{
    protected static ?string $heading = 'Advisor Diversity';

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
                    'label' => 'Fields',
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
