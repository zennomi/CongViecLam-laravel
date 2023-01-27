<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\PaymentSetting;
use App\Models\Timezone;
use Illuminate\Database\Seeder;
use Modules\Location\Entities\Country;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->email = 'jobpilot@zakirsoft.com';
        $setting->dark_logo = "frontend/assets/images/logo/logo.png";
        $setting->light_logo = "frontend/assets/images/logo/logowhite.png";
        $setting->favicon_image = "frontend/assets/images/logo/fav.png";
        $setting->sidebar_color = '#092433';
        $setting->sidebar_txt_color = '#C1D6F0';
        $setting->nav_color = '#0A243E';
        $setting->nav_txt_color = '#C1D6F0';
        $setting->main_color = '#0A65CC';
        $setting->accent_color = '#487CB8';
        $setting->frontend_primary_color = '#0A65CC';
        $setting->frontend_secondary_color = '#487CB8';
        $setting->working_process_step1_title = "Create Account";
        $setting->working_process_step1_description = "Aliquam facilisis egestas sapien, nec tempor leo tristique at.";
        $setting->working_process_step2_title = "Upload Cv Resume";
        $setting->working_process_step2_description = "Curabitur sit amet maximus ligula. Nam a nulla ante. Nam sodales";
        $setting->working_process_step3_title = "Find Suitable Job";
        $setting->working_process_step3_description = "Curabitur sit amet maximus ligula. Nam a nulla ante. Nam sodales";
        $setting->working_process_step4_title = "Apply Job";
        $setting->working_process_step4_description = "Curabitur sit amet maximus ligula. Nam a nulla ante. Nam sodales";
        $setting->default_map = 'google-map';
        $setting->google_map_key = '';
        $setting->map_box_key = '';
        $setting->default_long = 90.4112704917406;
        $setting->default_lat = 23.757853442382867;
        $setting->save();

        // Payment Setting
        PaymentSetting::create([
            'paypal' => true,
            'paypal_live_mode' => false,
            'stripe' => true,
            'razorpay' => true,
            'paystack' => true,
            'ssl_commerz' => true,
        ]);

        // Timezone
        foreach (timezone_identifiers_list() as $zone) {
            Timezone::insert(['value' => $zone]);
        }
    }
}
