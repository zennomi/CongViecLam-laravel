<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialiteController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:setting.view|setting.update'])->only(['index']);
        $this->middleware(['permission:setting.update'])->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.pages.socialite');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        switch ($request->type) {
            case 'google':
                $this->updateGoogleCredential($request);
                break;
            case 'facebook':
                $this->updateFacebookCredential($request);
                break;
            case 'twitter':
                $this->updateTwitterkCredential($request);
                break;
            case 'linkedin':
                $this->updateLinkedinkCredential($request);
                break;
            case 'github':
                $this->updateGithubCredential($request);
                break;
        }
    }

    /**
     * Update login with google credential
     *
     * @param Request $request
     * @return void
     */
    public function updateGoogleCredential(Request $request)
    {
        $request->validate([
            'google_client_id'      =>  ['required',],
            'google_client_secret'      =>  ['required',],
        ]);

        $this->updateEnv($request);
        setEnv('GOOGLE_LOGIN_ACTIVE', $request->google ? 'true' : 'false');
    }


    /**
     * Update login with facebook credential
     *
     * @param Request $request
     * @return void
     */
    public function updateFacebookCredential(Request $request)
    {
        $request->validate([
            'facebook_client_id'      =>  ['required',],
            'facebook_client_secret'      =>  ['required',],
        ]);

        $this->updateEnv($request);
        setEnv('FACEBOOK_LOGIN_ACTIVE', $request->facebook ? 'true' : 'false');
    }

    /**
     * Update login with twitter credential
     *
     * @param Request $request
     * @return void
     */
    public function updateTwitterkCredential(Request $request)
    {
        $request->validate([
            'twitter_client_id'      =>  ['required',],
            'twitter_client_secret'      =>  ['required',],
        ]);

        $this->updateEnv($request);
        setEnv('TWITTER_LOGIN_ACTIVE', $request->twitter ? 'true' : 'false');
    }

    /**
     * Update login with linkedin credential
     *
     * @param Request $request
     * @return void
     */
    public function updateLinkedinkCredential(Request $request)
    {
        $request->validate([
            'linkedin_client_id'      =>  ['required',],
            'linkedin_client_secret'      =>  ['required',],
        ]);

        $this->updateEnv($request);
        setEnv('LINKEDIN_LOGIN_ACTIVE', $request->linkedin ? 'true' : 'false');
    }

    /**
     * Update login with github credential
     *
     * @param Request $request
     * @return void
     */
    public function updateGithubCredential(Request $request)
    {
        $request->validate([
            'github_client_id'      =>  ['required',],
            'github_client_secret'      =>  ['required',],
        ]);

        $this->updateEnv($request);
        setEnv('GITHUB_LOGIN_ACTIVE', $request->github ? 'true' : 'false');
    }

    /**
     * Update Socialite login credential in .env file
     *
     * @param Request $request
     * @return void
     */
    protected function updateEnv(Request $request)
    {
        $data = $request->only([
            'google_client_id', 'google_client_secret', 'facebook_client_id', 'facebook_client_secret',
            'twitter_client_id', 'twitter_client_secret', 'linkedin_client_id', 'linkedin_client_secret', 'github_client_id',
            'github_client_secret'
        ]);

        foreach ($data as $key => $value) {
            if (env(strtoupper($key)) != $value) {
                setEnv(strtoupper($key), $value);
            }
        }

        session()->flash('success', ucfirst($request->type) . ' Setting update succcessfully!');

        return redirect()->route('settings.social.login')->send();
    }
}
