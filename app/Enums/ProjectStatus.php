<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ProjectStatus: string implements HasLabel
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
}
