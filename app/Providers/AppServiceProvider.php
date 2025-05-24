<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use BezhanSalleh\FilamentLanguageSwitch\Enums\Placement;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['en','es'])
                ->flags([
                    'en' => asset('flags/en.svg'),
                    'es' => asset('flags/es.svg')
                ])
                ->visible(outsidePanels: true)
                ->outsidePanelPlacement(Placement::TopRight)
                ->outsidePanelRoutes([
                    'login'
                    // Additional custom routes where the switcher should be visible outside panels
                ]);
        });

        
    }
}
