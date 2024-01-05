<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectTaskStatus: string implements HasColor, HasLabel
{
    case Assigned = 'assigned';
    case Cancelled = 'cancelled';
    case Completed = 'completed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Assigned => 'Assigned',
            self::Cancelled => 'Cancelled',
            self::Completed => 'Completed',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Assigned => 'gray',
            self::Cancelled => 'danger',
            self::Completed => 'success',
        };
    }
}
