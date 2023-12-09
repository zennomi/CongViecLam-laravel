<?php

namespace Database\Seeders;

use App\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'page_slug' => 'home',
                'title' => 'Chào mừng bạn đến với Paato',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'jobs',
                'title' => 'Việc làm',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'job-details',
                'title' => 'Chi tiết công việc',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'blog',
                'title' => 'Blog',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'pricing',
                'title' => 'Giá cả',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'login',
                'title' => 'Đăng nhập',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'register',
                'title' => 'Đăng ký',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'about',
                'title' => 'Về chúng tôi',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'contact',
                'title' => 'Liên hệ',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'faq',
                'title' => 'FAQ',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'terms-condition',
                'title' => 'Điều khoản và điều kiện',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ]
        ];

        foreach ($pages as $page) {
            Seo::create($page);
        }
    }
}
