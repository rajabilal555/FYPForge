<?php

namespace App\Filament\Student\Pages;

use App\Filament\Student\Widgets\ProjectFilesChart;
use App\Filament\Student\Widgets\ProjectInvites;
use App\Filament\Student\Widgets\ProjectTasksChart;
use App\Filament\Student\Widgets\TasksStatusChart;
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
            ProjectInvites::class,
            ProjectFilesChart::class,
            ProjectTasksChart::class,
            TasksStatusChart::class,
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
