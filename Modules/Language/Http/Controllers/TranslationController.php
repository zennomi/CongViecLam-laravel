<?php

namespace Modules\Language\Http\Controllers;

use stdClass;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Routing\Controller;
use Modules\Language\Entities\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationController extends Controller
{
    public function transUpdate(Request $request)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }

        $language = Language::findOrFail($request->lang_id);
        $data = file_get_contents(base_path('resources/lang/' . $language->code . '.json'));

        $translations = json_decode($data, true);

        foreach ($translations as $key => $value) {
            if ($request->$key && gettype($request->$key) == 'string') {
                $translations[$key] = $request->$key;
            } else {
                $translations[$key] = $value;
            }
        }

        $updated = file_put_contents(base_path('resources/lang/' . $language->code . '.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

        $updated ? flashSuccess('Translations updated successfully') : flashError();
        return back();
    }

    public function autoTransSingle(Request $request)
    {

        $text = autoTransLation($request->lang, $request->text);
        return response()->json($text);
    }

    public function langView($code)
    {
        if (!userCan('setting.update')) {
            return abort(403);
        }
        // if (!enableModule('language')) {
        //     return abort(404);
        // }

        $path = base_path('resources/lang/' . $code . '.json');
        $language = Language::where('code', $code)->first();
        $translations = json_decode(file_get_contents($path), true);

        return view('language::lang_view', compact('language', 'translations'));
    }

    public function changeLanguage($lang)
    {
        $lang = Language::where('code', $lang)->first();

        session(['current_lang' => $lang]);
        // session()->put('set_lang', $lang);
        app()->setLocale($lang);

        return back();
    }

    public function setDefaultLanguage(Request $request)
    {
        if (config('zakirsoft.default_language') != $request->code) {
            envReplace('APP_DEFAULT_LANGUAGE', $request->code);
        }

        if (session()->get('set_lang') != $request->code) {
            session()->put('set_lang', $request->code);
            app()->setLocale($request->code);
        }

        return back()->with('success', 'Default Language Added Successful');
    }
}
