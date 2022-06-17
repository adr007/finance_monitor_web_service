<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('mataUang', function ($money) {
            return "Rp. <?php echo number_format($money, 0, ',', '.'); ?>";
        });

        Blade::directive('mataUang2', function ($money) {
            return "Rp. <?php echo number_format($money, 0, ',', '.'); ?>";
        });
    }
}
