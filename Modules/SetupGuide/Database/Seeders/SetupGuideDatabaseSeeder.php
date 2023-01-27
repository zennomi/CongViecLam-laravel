<?php

namespace Modules\SetupGuide\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SetupGuide\Entities\SetupGuide;

class SetupGuideDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        SetupGuide::create([
            'task_name' => 'app_setting',
            'title' => 'App Information ',
            'description' => 'Add your app logo, name, description, owner and other information.',
            'action_route' => 'settings.general',
            'action_label' => 'Add App Information',
        ]);

        SetupGuide::create([
            'task_name' => 'smtp_setting',
            'title' => 'SMTP Configuration',
            'description' => 'Add your app logo, name, description, owner and other information.',
            'action_route' => 'settings.email',
            'action_label' => 'Add Mail Configuration',
        ]);

        SetupGuide::create([
            'task_name' => 'payment_setting',
            'title' => 'Enable Payment Method',
            'description' => 'Enable to payment methods to receive payments from your customer.',
            'action_route' => 'settings.payment',
            'action_label' => 'Add Payment',
        ]);

        SetupGuide::create([
            'task_name' => 'theme_setting',
            'title' => 'Customize Theme',
            'description' => 'Customize your theme to make your app look more attractive.',
            'action_route' => 'settings.theme',
            'action_label' => 'Customize Your App Now',
        ]);

        SetupGuide::create([
            'task_name' => 'map_configuration',
            'title' => 'Map configuration',
            'description' => 'Configure your map setting to set location',
            'action_route' => 'settings.general',
            'action_label' => 'Configure Now',
        ]);

        SetupGuide::create([
            'task_name' => 'set_location',
            'title' => 'Application Countries',
            'description' => 'Set application countries to get country based jobs',
            'action_route' => 'settings.general',
            'action_label' => 'Set Now',
        ]);
    }
}
