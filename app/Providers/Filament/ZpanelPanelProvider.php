<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ZpanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('zpanel')
            ->path('zpanel')

            ->brandLogo(asset("images/logo/zionhome-logo-1.png"))
            ->assets([
                \Filament\Support\Assets\Css::make(
                    "custom-stylesheet",
                    asset("css/app/custom-stylesheet.css"),
                ),
                \Filament\Support\Assets\Css::make(
                    "custom-stylesheet-fontawesome-all.min",
                    asset("css/app/custom-stylesheet-fontawesome-all.min.css"),
                ),
            ])

            ->unsavedChangesAlerts()
            ->databaseNotifications()
            ->profile(isSimple: true)
            ->globalSearch(false)
            ->login()

            ->colors([
                'primary' => Color::Blue,
            ])
            // ->viteTheme('resources/css/app.css')
            ->viteTheme('resources/css/filament/zpanel/theme.css')
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn() => new \Illuminate\Support\HtmlString('
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    ')
            )


            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                // Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                \Hammadzafar05\MobileBottomNav\MobileBottomNav::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
