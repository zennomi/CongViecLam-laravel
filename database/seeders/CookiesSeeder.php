<?php

namespace Database\Seeders;

use App\Models\Cookies;
use Illuminate\Database\Seeder;

class CookiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cookies = new Cookies();
        $cookies->allow_cookies = true;
        $cookies->cookie_name = 'gdpr_cookie';
        $cookies->cookie_expiration = 30;
        $cookies->force_consent = false;
        $cookies->darkmode = false;
        $cookies->language = 'en';
        $cookies->title = 'We use cookies!';
        $cookies->description = 'Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent. <button type="button" data-cc="c-settings" class="cc-link">Let me choose</button>';
        $cookies->approve_button_text = 'Allow all Cookies';
        $cookies->decline_button_text = 'Reject all Cookies';
        $cookies->save();
    }
}
