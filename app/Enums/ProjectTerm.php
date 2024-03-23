<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectTerm: string implements HasColor, HasLabel
{
    case FYP1 = 'FYP 1';
    case FYP2 = 'FYP 2';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FYP1 => 'FYP 1',
            self::FYP2 => 'FYP 2',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FYP1, self::FYP2 => 'gray',
        };
    }
}
