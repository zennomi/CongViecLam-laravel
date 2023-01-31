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
        $website->phone = "0394299564";
        $website->address = "Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội";
        $website->map_address = "Địa chỉ trên bản đồ";
        $website->facebook = "https://www.facebook.com";
        $website->instagram = "https://www.instagram.com";
        $website->twitter = "https://www.twitter.com";
        $website->youtube = "https://www.youtube.com";
        $website->title = "Chúng tôi là những người suy";
        $website->sub_title = "Chúng tôi là nhóm có nhiều kinh nghiệm trong lĩnh vực công nghệ";
        $website->description = 'Chúng tôi cũng cung cấp dịch vụ tuyển dụng nhân sự với các tính năng tiện lợi nhất cho nhà tuyển dụng và người tìm việc.';
        $website->live_job = "175,324";// edit after
        $website->companies = "97,354";// edit after
        $website->candidates = "3,847,154";// edit after
        $website->save();
    }
}
