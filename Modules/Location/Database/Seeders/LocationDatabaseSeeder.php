<?php

namespace Modules\Location\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Town;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Modules\Country\Entities\Country as EntitiesCountry;
use Illuminate\Support\Facades\Http;

class LocationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->makeCountry();
    }

    protected function makeCountry()
    {
        $countries_list = json_decode(file_get_contents(base_path('public/json/country.json')), true);

        for ($i = 0; $i < count($countries_list); $i++) {

            $country_data[] = [
                'name' => $countries_list[$i]['name'],
                'sortname' => $countries_list[$i]['country_code'],
                'slug' => Str::slug($countries_list[$i]['name']),
                'image' => 'backend/image/flags/flag-of-' . str_replace(" ", "-", $countries_list[$i]['name'] . '.jpg'),
                'icon' => 'flag-icon-' . Str::lower($countries_list[$i]['country_code']),
                "latitude" => $countries_list[$i]['latlng'][0],
                "longitude" => $countries_list[$i]['latlng'][1],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        $country_chunks = array_chunk($country_data, ceil(count($country_data) / 3));

        foreach ($country_chunks as $country) {
            Country::insert($country);
        }
    }
}
