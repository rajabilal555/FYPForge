<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProjectApprovalStatus: string implements HasColor, HasLabel
{
    case Draft = 'draft';
    case Reviewing = 'reviewing';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case NeedsRevision = 'needs_revision';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Reviewing => 'Reviewing',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
            self::NeedsRevision => 'Needs Revision',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Reviewing => 'info',
            self::Approved => 'success',
            self::Rejected => 'danger',
            self::NeedsRevision => 'warning',
        };
    }
}
