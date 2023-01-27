<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('candidate', function () {
            return auth('user')->user()->role == 'candidate';
        });

        Blade::if('company', function () {
            return auth('user')->user()->role == 'company';
        });

        Blade::if('currencyleft', function () {
            return config('zakirsoft.currency_symbol_position') == 'left';
        });
    }
}
