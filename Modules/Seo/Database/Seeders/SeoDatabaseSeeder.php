<?php

namespace Modules\Seo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Seo\Entities\Seo;

class SeoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        $pages = [
            [
                'page_slug' => 'home',
                'title' => 'Chào mừng bạn đến với Paato',
                'description' => 'Paato là một trang web tìm kiếm việc làm được thiết kế để tạo, quản lý các bài đăng việc làm. Các công ty có thể tạo hồ sơ của họ và đăng các công việc. Ứng viên có thể ứng tuyển việc làm.',
                'image' => 'frontend/assets/images/jobpilot.png',
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
                'page_slug' => 'candidates',
                'title' => 'Ứng viên',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'candidate-details',
                'title' => 'Chi tiết ứng viên',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'company',
                'title' => 'Doanh nghiệp',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'company-details',
                'title' => 'Chi tiết doanh nghiệp',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'blog',
                'title' => 'Blog',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'post-details',
                'title' => 'Post Details',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'pricing',
                'title' => 'Pricing',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'login',
                'title' => 'Đăng nhập',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'register',
                'title' => 'Đăng ký',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'about',
                'title' => 'About',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'contact',
                'title' => 'Contact',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'faq',
                'title' => 'FAQ',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'terms-condition',
                'title' => 'Điều khoản công việc',
                'description' => 'Paato is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
        ];

        foreach ($pages as $page) {
            Seo::create($page);
        }
    }
}
