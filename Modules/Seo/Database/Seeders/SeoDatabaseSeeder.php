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
                'title' => 'Welcome To CongViecLam',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'jobs',
                'title' => 'Jobs',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'job-details',
                'title' => 'Job Details',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'candidates',
                'title' => 'Candidates',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'candidate-details',
                'title' => 'Candidate Details',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'company',
                'title' => 'Company',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'company-details',
                'title' => 'Company Details',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'blog',
                'title' => 'Blog',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'post-details',
                'title' => 'Post Details',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'pricing',
                'title' => 'Pricing',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'login',
                'title' => 'Login',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'register',
                'title' => 'Register',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'about',
                'title' => 'About',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'contact',
                'title' => 'Contact',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'faq',
                'title' => 'FAQ',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],
            [
                'page_slug' => 'terms-condition',
                'title' => 'Terms Condition',
                'description' => 'CongViecLam is job portal laravel script designed to create, manage and publish jobs posts. Companies can create their profile and publish jobs posts. Candidate can apply job posts.',
                'image' => 'frontend/assets/images/jobpilot.png',
            ],


        ];

        foreach ($pages as $page) {
            Seo::create($page);
        }
    }
}
