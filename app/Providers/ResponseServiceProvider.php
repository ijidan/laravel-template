<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\ResponseRepo;

/**
 * εεΊζε‘
 * Class ResponseServiceProvider
 * @package App\Providers
 */
class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ResponseRepo::class, function () {
            return new ResponseRepo();
        });
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
