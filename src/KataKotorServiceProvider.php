<?php

namespace OmAlie\KataKotor;

use Illuminate\Support\ServiceProvider;
use OmAlie\KataKotor\Languages\BahasaIndonesia;
use OmAlie\KataKotor\Languages\English;

class KataKotorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/kata-kotor.php', 'kata-kotor');

        $this->app->singleton(KataKotorService::class, function ($app) {
            $langs = [
                BahasaIndonesia::class,
                English::class,
            ];
            if ($override = $app->config->get('kata-kotor.default_language')) {
                // Put override logic here if desired
            }
            return new KataKotorService($langs);
        });

        // Alias for Facade
        $this->app->alias(KataKotorService::class, 'kata-kotor');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/kata-kotor.php' => config_path('kata-kotor.php'),
        ], 'kata-kotor-config');
    }
}