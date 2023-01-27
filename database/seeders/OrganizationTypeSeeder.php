<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\OrganizationType;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Government', 'Semi Government', 'Public', 'Private', 'NGO', 'International Agencies'
        ];

        foreach ($types as $type) {
            OrganizationType::create([
                'name' => $type,
                'slug' => Str::slug($type)
            ]);
        }
    }
}
