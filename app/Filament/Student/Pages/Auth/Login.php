<?php

namespace App\Filament\Student\Pages\Auth;


use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    public function getTitle(): string|Htmlable
    {
        return __('Student') . ' ' . __('filament-panels::pages/auth/login.title');
    }

    public function getHeading(): string|Htmlable
    {
        return __('filament-panels::pages/auth/login.heading') . ' - ' . __('Student');
    }
}
