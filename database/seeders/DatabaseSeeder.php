<?php

namespace Database\Seeders;

use Database\Seeders\CmsSeeder;
use Illuminate\Database\Seeder;
use App\Models\ApplicationGroup;
use Database\Seeders\AdminSeeder;
use Database\Seeders\MasterSeeder;
use Database\Seeders\CookiesSeeder;
use Database\Seeders\EarningSeeder;
use Database\Seeders\JobRoleSeeder;
use Database\Seeders\JobTypeSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\TeamSizeSeeder;
use Database\Seeders\EducationSeeder;
use Database\Seeders\ExperienceSeeder;
use Database\Seeders\ProfessionSeeder;
use Database\Seeders\SalaryTypeSeeder;
use Database\Seeders\JobCategorySeeder;
use Database\Seeders\NationalitySeeder;
use Database\Seeders\IndustryTypeSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\WebsiteSettingSeeder;
use Database\Seeders\OrganizationTypeSeeder;
use Modules\Seo\Database\Seeders\SeoDatabaseSeeder;
use Modules\Location\Database\Seeders\LocationDatabaseSeeder;
use Modules\SetupGuide\Database\Seeders\SetupGuideDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // For Packaging
        $this->packagingVersion();
    }

    private function packagingVersion()
    {
        $this->call([
            RolePermissionSeeder::class,
            SettingSeeder::class,
            LocationDatabaseSeeder::class,
            WebsiteSettingSeeder::class,
            CmsSeeder::class,
            SeoDatabaseSeeder::class,
            SetupGuideDatabaseSeeder::class,
            CookiesSeeder::class,
            MasterSeeder::class,
            ApplicationGroupSeeder::class,

            // Attribute
            ProfessionSeeder::class,
            JobTypeSeeder::class,
            JobCategorySeeder::class,
            JobRoleSeeder::class,
            ExperienceSeeder::class,
            EducationSeeder::class,
            SalaryTypeSeeder::class,
            IndustryTypeSeeder::class,
            NationalitySeeder::class,
            OrganizationTypeSeeder::class,
            TeamSizeSeeder::class,
            CmsContentSeeder::class
        ]);
    }
}
