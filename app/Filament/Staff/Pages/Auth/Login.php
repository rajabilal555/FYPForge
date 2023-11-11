<?php

namespace App\Filament\Staff\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;

class Login extends BaseLogin
{
    public function getTitle(): string|Htmlable
    {
        return __('Staff') . ' ' . __('filament-panels::pages/auth/login.title');
    }

    public function getHeading(): string|Htmlable
    {
        return __('filament-panels::pages/auth/login.heading') . ' - ' . __('Staff');
    }
}
