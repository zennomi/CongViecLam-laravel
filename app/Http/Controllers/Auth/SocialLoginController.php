<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SocialSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Notification;
use App\Notifications\Admin\NewUserRegisteredNotification;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        session(['social_user' => request('user')]);

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $socialiteUserId = $socialiteUser->getId();
        $socialiteUserName = $socialiteUser->getName();
        $socialiteUseremail = $socialiteUser->getEmail();

        $user = User::where([
            'provider' => $provider,
            'provider_id' =>  $socialiteUserId,
        ])->first();

        if (!$user) {

            $validator = Validator::make(
                ['email' => $socialiteUseremail],
                ['email' => ['unique:users,email']],
                ['email.unique' => 'Couldn\'t login. Maybe you used a different login method?'],
            );

            if ($validator->fails()) {
                return redirect()->route('login')->withErrors($validator);
            }

            $user = User::create([
                'name' => $socialiteUserName,
                'email' => $socialiteUseremail,
                'username' => Str::slug($socialiteUserName) . '_' . Str::random(5),
                'provider' => $provider,
                'provider_id' =>  $socialiteUserId,
                'role' => session('social_user') == 'candidate' ? 'candidate' : 'company',
                'email_verified_at' => now(),
            ]);

            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new NewUserRegisteredNotification($admin, $user));
            }
        }

        Auth::guard('user')->login($user);

        return redirect()->route('user.dashboard');
    }

    public function dataUpdate(Request $request, $provider)
    {
        $socialSetting = SocialSetting::first();

        switch ($provider) {
            case 'google':
                if ($request->google) {
                    $request->validate([
                        'google_id' => 'required|string',
                        'google_secret' => 'required|string',
                    ]);
                }
                $this->googleSettings($request, $socialSetting);
                break;
            case 'facebook':
                if ($request->facebook) {
                    $request->validate([
                        'facebook_id' => 'required|string',
                        'facebook_secret' => 'required|string',
                    ]);
                }
                $this->facebookSettings($request, $socialSetting);
                break;
            case 'twitter':
                if ($request->twitter) {
                    $request->validate([
                        'twitter_id' => 'required|string',
                        'twitter_secret' => 'required|string',
                    ]);
                }
                $this->twitterSettings($request, $socialSetting);
                break;
            case 'linkedin':
                if ($request->linkedin) {
                    $request->validate([
                        'linkedin_id' => 'required|string',
                        'linkedin_secret' => 'required|string',
                    ]);
                }
                $this->linkedinSettings($request, $socialSetting);
                break;
            case 'github':
                if ($request->github) {
                    $request->validate([
                        'github_id' => 'required|string',
                        'github_secret' => 'required|string',
                    ]);
                }
                $this->githubSettings($request, $socialSetting);
                break;
            case 'gitlab':
                if ($request->gitlab) {
                    $request->validate([
                        'gitlab_id' => 'required|string',
                        'gitlab_secret' => 'required|string',
                    ]);
                }
                $this->gitlabSettings($request, $socialSetting);
                break;
        }


        flashSuccess('Social Setting Updated Successfully');
        return back();

        return $request->all();
    }
}
