<x-filament-panels::page>
    @php
    $normalizeWidgetClass = function (string | Filament\Widgets\WidgetConfiguration $widget): string {
    if ($widget instanceof \Filament\Widgets\WidgetConfiguration) {
    return $widget->widget;
    }

    return $widget;
    };
    @endphp

    @livewire($normalizeWidgetClass(\App\Filament\Student\Widgets\AdvisorList::class))
</x-filament-panels::page>