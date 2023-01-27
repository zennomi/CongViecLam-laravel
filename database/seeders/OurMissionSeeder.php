<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OurMission;

class OurMissionSeeder extends Seeder
{
    public function run()
    {

        $ourmission = New OurMission();
       // $ourmission->image = '';
        $ourmission->save();
    }
}
