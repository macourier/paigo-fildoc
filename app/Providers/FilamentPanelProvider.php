<?php

namespace App\Providers;

use App\Filament\Resources\EmployeeResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Panel;
use Filament\PanelProvider as BasePanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class FilamentPanelProvider extends BasePanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => '#4f46e5',
            ])
            // Enregistrement explicite des resources
            ->resources([
                EmployeeResource::class,
            ])
            // Middlewares web explicites
            ->middleware([
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
            ])
            // Auth Filament
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
