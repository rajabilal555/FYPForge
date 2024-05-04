<?php

namespace App\Providers\Filament;

use App\Filament\Evaluator\Pages\Auth\Login;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Notifications\Livewire\Notifications;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class EvaluatorPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        Notifications::verticalAlignment(VerticalAlignment::End);

        return $panel
            ->id('evaluator')
            ->path('evaluator')
            ->authGuard('evaluator')
            ->login(Login::class)
//            ->profile()
            ->brandLogo(fn () => asset('logo.png'))
            ->colors([
                'primary' => '#0c54a3',
            ])
            ->viteTheme('resources/css/app.css')
            ->maxContentWidth('full')
            ->darkMode(false)
            ->topNavigation()
            ->navigation(false)
            ->discoverResources(in: app_path('Filament/Evaluator/Resources'), for: 'App\\Filament\\Evaluator\\Resources')
            ->discoverPages(in: app_path('Filament/Evaluator/Pages'), for: 'App\\Filament\\Evaluator\\Pages')
            ->pages([])
            ->discoverWidgets(in: app_path('Filament/Evaluator/Widgets'), for: 'App\\Filament\\Evaluator\\Widgets')
//            ->databaseNotifications()
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
