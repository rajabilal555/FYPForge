<?php

namespace App\Filament\Advisor\Pages;

use App\Filament\Advisor\Widgets\ProjectFilesChart;
use App\Filament\Advisor\Widgets\ProjectInvites;
use App\Filament\Advisor\Widgets\ProjectQueriesChart;
use App\Filament\Advisor\Widgets\ProjectsListTable;
use App\Filament\Advisor\Widgets\ProjectTasksChart;
use App\Filament\Advisor\Widgets\TasksStatusChart;
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
            // AccountWidget::class,
            ProjectsListTable::class,
            ProjectInvites::class,
            TasksStatusChart::class,
            ProjectQueriesChart::class,
            ProjectTasksChart::class,
            ProjectFilesChart::class,
        ];
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int|string|array
    {
        return [
            'md' => 2,
            'lg' => 3,
        ];
    }
}
