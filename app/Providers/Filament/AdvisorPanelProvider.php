<?php

namespace App\Providers\Filament;

use App\Filament\Advisor\Pages\Auth\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Notifications\Livewire\Notifications;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdvisorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        Notifications::verticalAlignment(VerticalAlignment::End);

        return $panel
            ->id('advisor')
            ->path('advisor')
            ->authGuard('advisor')
            ->login(Login::class)
            ->profile()
            ->brandLogo(fn () => asset('logo.png'))
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->viteTheme('resources/css/app.css')
            ->maxContentWidth('full')
            ->darkMode(false)
            ->discoverResources(in: app_path('Filament/Advisor/Resources'), for: 'App\\Filament\\Advisor\\Resources')
            ->discoverPages(in: app_path('Filament/Advisor/Pages'), for: 'App\\Filament\\Advisor\\Pages')
            ->discoverWidgets(in: app_path('Filament/Advisor/Widgets'), for: 'App\\Filament\\Advisor\\Widgets')
            ->databaseNotifications()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
