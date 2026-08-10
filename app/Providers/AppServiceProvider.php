<?php

namespace App\Providers;

use App\Services\AlertCvaService;
use App\Services\BadgeCvaService;
use App\Services\ButtonCvaService;
use App\Services\DialogCvaService;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AlertCvaService::class, fn () => AlertCvaService::new());
        $this->app->singleton(BadgeCvaService::class, fn () => BadgeCvaService::new());
        $this->app->singleton(ButtonCvaService::class, fn () => ButtonCvaService::new());
        $this->app->singleton(DialogCvaService::class, fn () => DialogCvaService::new());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::forceAssetInjection();
        $this->configureDefaults();
        if (app()->isProduction()) {
            URL::forceScheme('https');
        }
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
