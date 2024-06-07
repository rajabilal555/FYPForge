<?php

namespace App\Filament\Student\Pages;

use App\Filament\Student\Widgets\ProjectInvites;
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
