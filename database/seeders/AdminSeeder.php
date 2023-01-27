<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $role = Role::first();
        $admin = new Admin();
        $admin->name = "Zakir Soft";
        $admin->email = "developer@mail.com";
        $admin->image = "backend/image/default.png";
        $admin->password = bcrypt('password@12345');
        $admin->email_verified_at = Carbon::now();
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->assignRole($role);

        $admin = new Admin();
        $admin->name = "Admin";
        $admin->email = "admin@mail.com";
        $admin->image = "backend/image/default.png";
        $admin->password = bcrypt('password');
        $admin->email_verified_at = Carbon::now();
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->assignRole($role);
    }
}
