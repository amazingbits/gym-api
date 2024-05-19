<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CalculateDistanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . "/Helpers/calculate_distance_helper.php";
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
