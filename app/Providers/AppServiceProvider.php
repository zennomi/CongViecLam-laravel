<?php

namespace App\Providers;

use App\Models\Cms;
use App\Models\Cookies;
use App\Models\Setting;
use App\Models\WebsiteSetting;
use Illuminate\Pagination\Paginator;
use Modules\Location\Entities\Country;
use Illuminate\Support\ServiceProvider;
use Modules\Language\Entities\Language;
use Modules\SetupGuide\Entities\SetupGuide;

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
        Paginator::useBootstrap();

        if (!app()->runningInConsole()) {
            $setting = Setting::first();

            $default_language = Language::where('code', config('zakirsoft.default_language'))->first();
            view()->share('defaultLanguage', $default_language);

            // view()->share('adminNotifications', auth()->user()->notifications()->take(10));
            $cookies = Cookies::first();
            view()->share('cookies', $cookies);

            $appSetup = SetupGuide::orderBy('status', 'asc')->get();
            view()->share('appSetup', $appSetup);

            view()->share('website_setting', WebsiteSetting::first());
            view()->share('cms_setting', Cms::first());

            view()->share('hcountries',  Country::all());

            $appSetup = SetupGuide::orderBy('status', 'asc')->get();
            view()->share('appSetup', $appSetup);

            view()->share('setting', $setting);
            view()->share('currency_symbol', config('jobpilot.currency_symbol'));

            $languages = Language::all();
            $headerCountries = Country::select('id', 'name', 'slug', 'icon')->active()->get();
            view()->share('languages', $languages);
            view()->share('headerCountries', $headerCountries);
            if ($setting) {
                if ($setting->commingsoon_mode) {
                    session()->put('commingsoon_mode', $setting->commingsoon_mode);
                }
            }
        }
    }
}
