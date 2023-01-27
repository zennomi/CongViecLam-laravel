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
                'title' => 'Welcome To CongViecLam',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'blog',
                'title' => 'Blog',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'pricing',
                'title' => 'Pricing',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'login',
                'title' => 'Login',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'register',
                'title' => 'Register',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'about',
                'title' => 'About',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'contact',
                'title' => 'Contact',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'faq',
                'title' => 'FAQ',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ],
            [
                'page_slug' => 'terms-condition',
                'title' => 'Terms Condition',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => asset('frontend/assets/images/jobpilot.png'),
            ]
        ];

        foreach ($pages as $page) {
            Seo::create($page);
        }
    }
}
