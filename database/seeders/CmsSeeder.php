<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cms = new Cms();

        //About page
        $cms->about_brand_logo = "frontend/assets/images/all-img/brand-1.png";
        $cms->about_brand_logo1 = "frontend/assets/images/all-img/brand-2.png";
        $cms->about_brand_logo2 = "frontend/assets/images/all-img/brand-1.png";
        $cms->about_brand_logo3 = "frontend/assets/images/all-img/brand-2.png";
        $cms->about_brand_logo4 = "frontend/assets/images/all-img/brand-1.png";
        $cms->about_brand_logo5 = "frontend/assets/images/all-img/brand-2.png";
        $cms->about_banner_img = "frontend/assets/images/banner/about-banner-1.jpg";
        $cms->about_banner_img1 = "frontend/assets/images/banner/about-banner-2.jpg";
        $cms->about_banner_img2 = "frontend/assets/images/banner/about-banner-3.jpg";
        $cms->about_banner_img3 = "frontend/assets/images/banner/about-banner-4.jpg";
        $cms->mission_image = "frontend/assets/images/banner/about-banner-5.png";
        $cms->candidate_image = "frontend/assets/images/all-img/cta-1.png";
        $cms->employers_image = "frontend/assets/images/all-img/cta-2.png";
        $cms->contact_map = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.2278794778554!2d90.34898411536302!3d23.77489829375602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1e1938cc90b%3A0xbcfacb6b89117685!2sZakir%20Soft%20-%20Innovative%20Software%20%26%20Web%20Development%20Solutions!5e0!3m2!1sen!2sbd!4v1629355846404!5m2!1sen!2sbd" width="100%" height="536" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        $cms->register_page_image = "frontend/assets/images/all-img/auth-img.png";
        $cms->login_page_image = "frontend/assets/images/all-img/auth-img.png";
        $cms->page403_image = "frontend/assets/images/banner/error-banner.png";

        $cms->page404_image = "frontend/assets/images/banner/error-banner.png";

        $cms->page500_image = "frontend/assets/images/banner/error-banner.png";

        $cms->page503_image = "frontend/assets/images/banner/error-banner.png";

        $cms->comingsoon_image = "frontend/assets/images/all-img/coming-banner.png";

        $cms->footer_phone_no = "+84394299564";
        $cms->footer_address = "Số 1 Đại Cồ Việt,Hai Bà Trưng, Hà Nội";
        $cms->footer_facebook_link = "https://www.facebook.com/Zennomi";
        $cms->footer_instagram_link = "https://www.facebook.com/Zennomi";
        $cms->footer_twitter_link = "https://www.facebook.com/Zennomi";
        $cms->footer_youtube_link = "https://www.facebook.com/Zennomi";
        $cms->privary_page = "<h2>01. Chính sách</h2><p>Liên hệ với chúng tôi để biết thêm thông tin chi tiết.</p><p><br>&nbsp;</p>";
        $cms->terms_page = "<h2>01. Điều khoản; Điều kiện</h2><p></li><li>Liên hệ với chúng tôi để biết thêm thông tin chi tiết.</p><p><br>&nbsp;</p>";
       
        $cms->maintenance_image = "frontend/assets/images/all-img/coming-banner.png";

        $cms->save();
    }
}
