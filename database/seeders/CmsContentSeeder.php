<?php

namespace Database\Seeders;

use App\Models\cms;
use App\Models\CmsContent;
use Illuminate\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cms = cms::first();

        CmsContent::create([
            'page_slug' => 'terms_condition_page',
            'translation_code' => 'en',
            'text' => $cms->terms_page
        ]);

        CmsContent::create([
            'page_slug' => 'privacy_page',
            'translation_code' => 'en',
            'text' => $cms->privary_page
        ]);
    }
}