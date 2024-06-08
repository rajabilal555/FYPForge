<?php

namespace App\Filament\Staff\Pages;

use App\Filament\Staff\Widgets\AdvisorDiversityChart;
use App\Filament\Staff\Widgets\ProjectStatusChart;
use App\Filament\Staff\Widgets\StatsOverview;
use App\Filament\Staff\Widgets\StudentStatusesChart;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
//            AccountWidget::class,
            StatsOverview::class,
            ProjectStatusChart::class,
            AdvisorDiversityChart::class,
            StudentStatusesChart::class,
        ];
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int|string|array
    {
        return 2;
    }
}
