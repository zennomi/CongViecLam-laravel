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
        $website->phone = "+8496142728";
        $website->address = "Trường ĐH Kinh tế Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội";
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
