<?php

namespace App\Livewire;

use Filament\Widgets\Widget;

class AlertWidget extends Widget
{
    protected static string $view = 'livewire.alert';

    public $title;

    public $message;

    public $type;

}
