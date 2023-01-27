<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\DB;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website = new WebsiteSetting();
        $website->phone = "(319) 555-0115";
        $website->address = "6391 Elgin St. Celina, Delaware 10299, New York, United States of America";
        $website->map_address = 'Your Map';
        $website->facebook = "https://www.facebook.com";
        $website->instagram = "https://www.instagram.com";
        $website->twitter = "https://www.twitter.com";
        $website->youtube = "https://www.youtube.com";
        $website->title = "Who we are";
        $website->sub_title = "We’re highly skilled and professionals team.";
        $website->description = 'Praesent non sem facilisis, hendrerit nisi vitae, volutpat quam. Aliquam metus mauris, semper eu eros vitae, blandit tristique metus. Vestibulum maximus nec justo sed maximus.';
        $website->live_job = "175,324";
        $website->companies = "97,354";
        $website->candidates = "3,847,154";
        $website->save();
    }
}
