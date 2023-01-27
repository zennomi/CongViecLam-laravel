<?php

namespace App\Actions\Profile;

use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;

class ProfileUpdate
{
    /**
     * Profile Update.
     *
     * @param object $request
     * @return boolean
     */
    public static function update(object $request)
    {
        if ($request->isPasswordChange) {
            $pass_change_done = self::change_password($request);

            if ($pass_change_done) {
                return self::profile_data($request);
            } else {
                return $pass_change_done;
            }
        } else {
            return self::profile_data($request);
        }
    }

    /**
     * Profile data Update.
     *
     * @param object $request
     * @return boolean
     */
    protected static function profile_data(object $request)
    {
        $user = SuperAdmin::find(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;

        if ($image = $request->image) {
            $url = uploadImage($image, 'user');
            $user->image = $url;
        }

        $user->save();
        return true;
    }

    /**
     * Password  Update.
     *
     * @param object $request
     * @return boolean
     */
    protected static function change_password(object $request)
    {
        $password_check = Hash::check($request->current_password, auth()->user()->password);

        if ($password_check) {
            $user = SuperAdmin::findOrFail(auth()->id());
            $user->update([
                'password' => bcrypt($request->password),
                'updated_at' => now(),
            ]);

            return true;
        } else {
            return false;
        }
    }
}
