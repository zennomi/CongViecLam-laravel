<?php

namespace App\Actions\User;

use App\Models\Admin;


class CreateUser
{
    public static function create(object $request)
    {
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($image = $request->image) {
            $url = uploadImage($image, 'user');
            $user->image = $url;
        }
        $user->password = bcrypt($request->password);
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return true;
    }
}
