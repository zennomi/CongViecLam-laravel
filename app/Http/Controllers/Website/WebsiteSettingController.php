<?php

namespace App\Http\Controllers\Website;

use App\Models\Cms;
use App\Models\About;
use App\Models\CmsContent;
use App\Models\OurMission;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Http\Controllers\Controller;
use Modules\Language\Entities\Language;

class WebsiteSettingController extends Controller
{
    // home data
    public function website_setting()
    {
        abort_if(!userCan('setting.view'), 403);

        if (!session('tab_part')) {
            session(['tab_part' => 'home']);
        }

        $about_list = Cms::first();
        $website_setting = WebsiteSetting::first();
        $path = base_path('Modules/Language/Resources/json/languages.json');
        $languages = Language::all();

        $cms_content = CmsContent::with('language')->whereIn('page_slug', ['terms_condition_page', 'privacy_page'])->get();

        $privacy_page_list = $cms_content->where('page_slug', 'privacy_page');
        $terms_condition_page_list = $cms_content->where('page_slug', 'terms_condition_page');

        $terms_page = null;
        $privacy_page = null;

        $exist_cms_content = $cms_content->where('page_slug', 'terms_condition_page')->where('translation_code', session()->get('terms_condition_page'))->first();
        if ($exist_cms_content) {
            $terms_page = $exist_cms_content->text;
        }

        $exist_cms_content_privacy = $cms_content->where('page_slug', 'privacy_page')->where('translation_code', session()->get('privacy_page'))->first();
        if ($exist_cms_content_privacy && session()->get('privacy_page')) {
            $privacy_page = $exist_cms_content_privacy->text;
        }

        return view('admin.settings.pages.website_setting', compact('about_list', 'languages', 'terms_page', 'privacy_page', 'privacy_page_list', 'terms_condition_page_list'));
    }

    public function show()
    {
        //edit data
        $websitesetting = WebsiteSetting::all();
        return view('admin.websitesetting.index', compact('websitesetting'));
    }

    //update
    public function websitesettingupdate(Request $req, WebsiteSetting $WebsiteSetting)
    {
        $edit_id = $req->content_id;

        $WebsiteSetting = WebsiteSetting::where('id', $edit_id)->update([

            'phone' => $req->phone,
            'address' => $req->address,
            'map_address' => $req->map_address,
            'facebook' => $req->facebook,
            'instagram' => $req->instagram,
            'twitter' => $req->twitter,
            'youtube' => $req->youtube,
        ]);
        //  $WebsiteSetting->save();
        return back()->with('success', 'Website setting upadte successfully!');
    }

    public function sessionUpdateTermsPrivacy(Request $request)
    {
        $cms =  Cms::first();

        if ($request->has('session')) {
            session(['tab_part' => $request->session]);
        }
        if ($request->type == 'terms-page') {

            session()->put('terms_condition_page', $request->exist_check);
            $exist_cms_content = CmsContent::where('translation_code', $request->exist_check)->where('page_slug', 'terms_condition_page')->first();
            if ($exist_cms_content) {
                $exist_cms_content->update([
                    'text' => $exist_cms_content->text
                ]);
            } else {
                CmsContent::create([
                    'page_slug' => 'terms_condition_page',
                    'translation_code' => $request->exist_check,
                    'text' => $cms->terms_page
                ]);
            }
        }
        if ($request->type == 'privacy-page') {

            $exist_cms_content2 = CmsContent::where('translation_code', $request->exist_check)->where('page_slug', 'privacy_page')->first();

            session()->put('privacy_page', $request->exist_check);

            if ($exist_cms_content2) {
                $exist_cms_content2->update([
                    'text' => $exist_cms_content2->text
                ]);
            } else {
                CmsContent::create([
                    'page_slug' => 'privacy_page',
                    'translation_code' => $request->exist_check,
                    'text' => $cms->privary_page
                ]);
            }
        }
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        } else {
            return redirect()->back();
        }
    }

    public function cmsContentDestroy(Request $request)
    {

        $content = CmsContent::FindOrFail($request->content_id);

        if ($content->page_slug == 'privacy_page') {
            session()->put('privacy_page', 'en');
        } else {
            session()->put('terms_condition_page', 'en');
        }
        $content->delete();


        flashSuccess('Data Deleted !');
        return redirect()->back();
    }

    public function about()
    {

        return view('admin.websitesetting.index', compact('about_list'));
    }
    public function aboutupdate(Request $req, About $about)
    {
        return $about = $req->about_id;


        if ($req->file('img1')) {
            // deleteImage($ourmission->mission_image);
            // $url = $req->image->move('uploads/ourmission',$req->image->hashName());
            return $req->img1;


            //  $ourmission =OurMission::where('id',$ourmissionid)->update([
            //     'mission_image' => $url,

            // ]);
        }
        //  return $about_id = $req->about_id;

        //  $WebsiteSetting->save();
        return back()->with('success', 'Website setting About upadte successfully!');
    }

    public function ourmissionupdate(Request $req, OurMission $ourmission)
    {

        $ourmissionid = $req->missionid;
        // return $ourmissionid;
        if ($req->hasFile('mission_image') && $req->file('mission_image')->isValid()) {
            deleteImage($ourmission->mission_image);
            $url = $req->image->move('uploads/ourmission', $req->image->hashName());

            $ourmission = OurMission::where('id', $ourmissionid)->update([
                'mission_image' => $url,

            ]);
        }


        return back()->with('success', 'Website setting Our Mission upadte successfully!');
    }
}
