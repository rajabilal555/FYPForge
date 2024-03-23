<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasColor, HasLabel
{
    case InProgress = 'in_progress';
    case Graded = 'graded';
    case Failed = 'failed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::InProgress => 'In Progress',
            self::Graded => 'Graded',
            self::Failed => 'Failed',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::InProgress => 'warning',
            self::Graded => 'success',
            self::Failed => 'danger',
        };
    }
}
