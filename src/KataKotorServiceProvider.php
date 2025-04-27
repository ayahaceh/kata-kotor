<?php

namespace OmAlie\KataKotor;

use Illuminate\Support\ServiceProvider;
use OmAlie\KataKotor\Languages\BahasaIndonesia;
use OmAlie\KataKotor\Languages\English;
use OmAlie\KataKotor\Languages\IndoAceh;

class KataKotorServiceProvider extends ServiceProvider
{
    /**
     * Register the application's services.
     *
     * @return void
     */
    public function register(): void
    {
        // Menggabungkan konfigurasi
        $this->mergeConfigFrom(__DIR__.'/../config/kata-kotor.php', 'kata-kotor');

        // Menyediakan layanan KataKotorService
        $this->app->singleton(KataKotorService::class, function ($app) {
            // Mendapatkan daftar bahasa dari konfigurasi
            $langs = [
                BahasaIndonesia::class,
                English::class,
                IndoAceh::class,
            ];

            // Cek apakah ada override bahasa dalam konfigurasi
            $override = $app->config->get('kata-kotor.default_language');
            if ($override) {
                // Logika untuk override bahasa bisa ditambahkan di sini
            }

            // Return layanan dengan bahasa yang sudah disiapkan
            return new KataKotorService($langs);
        });

        // Alias untuk kemudahan pemanggilan melalui facade
        $this->app->alias(KataKotorService::class, 'kata-kotor');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Menyediakan file konfigurasi untuk dipublikasikan
        $this->publishes([
            __DIR__.'/../config/kata-kotor.php' => config_path('kata-kotor.php'),
        ], 'kata-kotor-config');
    }
}
