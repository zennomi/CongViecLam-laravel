<?php

namespace App\Actions\User;

class UpdateUser
{
    public static function update(object $request, object $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if ($image = $request->image) {
            $url = uploadImage($image, 'user');
            $user->image = $url;
        }

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return true;

        // if ($request->has('image')) {
        //     $image = $request->image;
        //     $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        //     Storage::putFileAs('public/user', $image, $fileName);
        //     $db_image = 'storage/user/' . $fileName;
        //     $user->image = $db_image;
        // }

    }
}
