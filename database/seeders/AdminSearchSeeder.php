<?php

namespace Database\Seeders;

use App\Models\AdminSearch;
use Illuminate\Database\Seeder;

class AdminSearchSeeder extends Seeder
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
                'page_title' => 'Dashboard',
                'url' => asset('admin/dashboard'),
            ],
            [
                'page_title' => 'All Users',
                'url' => asset('admin/user'),
            ],
            [
                'page_title' => 'Create User',
                'url' => asset('admin/user/create'),
            ],
            [
                'page_title' => 'All Roles',
                'url' => asset('admin/role'),
            ],
            [
                'page_title' => 'Create Role',
                'url' => asset('admin/role/create'),
            ],
            [
                'page_title' => 'Settings',
                'url' => asset('admin/settings/general'),
            ],
            [
                'page_title' => 'Website',
                'url' => asset('admin/settings/general'),
            ],
            [
                'page_title' => 'Profile',
                'url' => asset('admin/profile'),
            ],
            [
                'page_title' => 'Profile Update',
                'url' => asset('admin/profile/settings'),
            ],
            [
                'page_title' => 'Layout Settings',
                'url' => asset('admin/settings/layout'),
            ],
            [
                'page_title' => 'Language',
                'url' => asset('admin/settings/languages'),
            ],
            [
                'page_title' => 'Language Create',
                'url' => asset('admin/settings/languages/create'),
            ],
            [
                'page_title' => 'Theme Settings',
                'url' => asset('admin/settings/theme'),
            ],
            [
                'page_title' => 'Custom CSS & JS',
                'url' => asset('admin/settings/custom'),
            ],
            [
                'page_title' => 'Mail Settings',
                'url' => asset('admin/settings/email'),
            ],
            [
                'page_title' => 'Currency',
                'url' => asset('admin/settings/currency'),
            ],
            [
                'page_title' => 'Create Currency',
                'url' => asset('admin/settings/currency/create'),
            ],
            [
                'page_title' => 'App Settings',
                'url' => asset('admin/settings/system'),
            ],
            [
                'page_title' => 'System',
                'url' => asset('admin/settings/system'),
            ],
            [
                'page_title' => 'SEO',
                'url' => asset('admin/settings/seo'),
            ],
            [
                'page_title' => 'Social Login',
                'url' => asset('admin/settings/social-login'),
            ],
            [
                'page_title' => 'Payment',
                'url' => asset('admin/settings/payment'),
            ],
            [
                'page_title' => 'Paypal',
                'url' => asset('admin/settings/payment'),
            ],
        ];

        foreach ($pages as $page) {
            AdminSearch::create($page);
        }
    }
}
