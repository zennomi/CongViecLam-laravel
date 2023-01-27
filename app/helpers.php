<?php

use App\Models\Job;
use App\Models\Company;
use App\Models\Cookies;
use App\Models\Setting;
use App\Models\Candidate;
use Illuminate\Support\Str;
use msztorc\LaravelEnv\Env;
use Modules\Seo\Entities\Seo;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ViewErrorBag;
use Modules\Location\Entities\Country;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Modules\Language\Entities\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;
use AmrShawky\LaravelCurrency\Facade\Currency;

// =====================================================
// ===================Image Function====================
// =====================================================
if (!function_exists('uploadImage')) {
    function uploadImage($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/' . $path . '/'), $fileName);

        return "uploads/$path/" . $fileName;
    }
}

/**
 * image delete
 *
 * @param string $image
 * @return void
 */
if (!function_exists('deleteFile')) {
    function deleteFile(?string $image)
    {
        $imageExists = file_exists($image);

        if ($imageExists) {
            if ($imageExists != 'backend/image/default.png') {
                @unlink($image);
            }
        }
    }
}

/**
 * image delete
 *
 * @param string $image
 * @return void
 */
if (!function_exists('deleteImage')) {
    function deleteImage(?string $image)
    {
        $imageExists = file_exists($image);

        if ($imageExists) {
            if ($imageExists != 'backend/image/default.png') {
                @unlink($image);
            }
        }
    }
}

/**
 * @param UploadedFile $file
 * @param null $folder
 * @param string $disk
 * @param null $filename
 * @return false|string
 */
if (!function_exists('uploadOne')) {
    function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : uniqid('FILE_') . dechex(time());

        return $file->storeAs(
            $folder,
            $name . "." . $file->getClientOriginalExtension(),
            $disk
        );
    }
}

/**
 * @param null $path
 * @param string $disk
 */
if (!function_exists('deleteOne')) {
    function deleteOne($path = null, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}

if (!function_exists('uploadFileToStorage')) {
    function uploadFileToStorage($file, string $path)
    {
        $file_name = $file->hashName();
        Storage::putFileAs($path, $file,  $file_name);
        return $path . '/' .  $file_name;
    }
}

if (!function_exists('uploadFileToPublic')) {
    function uploadFileToPublic($file, string $path)
    {
        if ($file && $path) {
            $url = $file->move('uploads/' . $path, $file->hashName());
        } else {
            $url = null;
        }

        return $url;
    }
}

// =====================================================
// ===================Env Function====================
// =====================================================
if (!function_exists('envReplace')) {
    function envReplace($name, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name),
                $name . '=' . $value,
                file_get_contents($path)
            ));
        }

        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
    }
}

if (!function_exists('setEnv')) {
    function setEnv($key, $value)
    {
        if ($key && $value) {
            $env = new Env();
            $env->setValue($key, $value);
        }

        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
    }
}

if (!function_exists('checkSetEnv')) {

    function checkSetEnv($key, $value)
    {
        if ((env($key) != $value)) {
            setEnv($key, $value);
        }
    }
}

if (!function_exists('error')) {
    function error($name, $class = 'is-invalid')
    {
        $errors = session()->get('errors', app(ViewErrorBag::class));

        return $errors->has($name) ? $class : '';
    }
}

if (!function_exists('allowLaguageChanage')) {
    function allowLaguageChanage()
    {
        return Setting::first()->language_changing ? true : false;
    }
}

// ========================================================
// ===================Response Function====================
// ========================================================

/**
 * Response success data collection
 *
 * @param object $data
 * @param string $responseName
 * @return \Illuminate\Http\Response
 */
if (!function_exists('responseData')) {
    function responseData(?object $data, string $responseName = 'data')
    {
        return response()->json([
            'success' => true,
            $responseName => $data,
        ], 200);
    }
}

/**
 * Response success data collection
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
if (!function_exists('responseSuccess')) {
    function responseSuccess(string $msg = "Success")
    {
        return response()->json([
            'success' => true,
            'message' => $msg,
        ], 200);
    }
}

/**
 * Response error data collection
 *
 * @param string $msg
 * @param int $code
 * @return \Illuminate\Http\Response
 */
if (!function_exists('responseError')) {
    function responseError(string $msg = 'Something went wrong, please try again', int $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $msg,
        ], $code);
    }
}

/**
 * Response success flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
if (!function_exists('flashSuccess')) {
    function flashSuccess(string $msg)
    {
        session()->flash('success', $msg);
    }
}


/**
 * Response error flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
if (!function_exists('flashError')) {
    function flashError(string $message = null)
    {
        if (config('app.debug')) {
            return session()->flash('error', $message);
        } else {
            return session()->flash('error', 'Something went wrong, please try again');
        }
    }
}

/**
 * Response warning flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
if (!function_exists('flashWarning')) {
    function flashWarning(string $message, bool $custom = false)
    {
        if ($custom) {
            return session()->flash('warning', $message);
        } else {
            if (config('app.debug')) {
                return session()->flash('warning', $message);
            } else {
                return session()->flash('warning', 'please try again');
            }
        }
    }
}

// ========================================================
// ===================Others Function====================
// ========================================================
if (!function_exists('setting')) {
    function setting($fields = null, $append = false)
    {
        if ($fields) {
            $type = gettype($fields);

            if ($type == 'string') {
                $data = $append ? Setting::first($fields) : Setting::value($fields);
            } elseif ($type == 'array') {
                $data = Setting::first($fields);
            }
        } else {
            $data = Setting::first();
        }

        if ($append) {
            $data = $data->makeHidden(['dark_logo_url', 'light_logo_url', 'favicon_image_url']);
        }

        return $data;
    }
}

if (!function_exists('autoTransLation')) {
    function autoTransLation($lang, $text)
    {
        $tr = new GoogleTranslate($lang);
        $afterTrans = $tr->translate($text);
        return $afterTrans;
    }
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
if (!function_exists('userCan')) {
    function userCan($permission)
    {
        return auth('admin')->user()->can($permission);
    }
}

if (!function_exists('pdfUpload')) {

    function pdfUpload(?object $file, string $path): string
    {

        $filename = time() . '.' . $file->extension();
        $filePath = public_path('uploads/' . $path);
        $file->move($filePath, $filename);

        return $filePath . $filename;
    }
}

if (!function_exists('remainingDays')) {

    function remainingDays($deadline)
    {
        $now = Carbon::now();
        $cDate = Carbon::parse($deadline);
        return $now->diffInDays($cDate);
    }
}

if (!function_exists('jobStatus')) {

    function jobStatus($deadline)
    {
        $now = Carbon::now();
        $cDate = Carbon::parse($deadline);

        if ($now->greaterThanOrEqualTo($cDate)) {
            return 'Expire';
        } else {
            return 'Active';
        }
    }
}

if (!function_exists('socialMediaShareLinks')) {

    function socialMediaShareLinks(string $path, string $provider)
    {
        switch ($provider) {
            case 'facebook':
                $share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $path;
                break;
            case 'twitter':
                $share_link = 'https://twitter.com/intent/tweet?text=' . $path;
                break;
            case 'pinterest':
                $share_link = 'http://pinterest.com/pin/create/button/?url=' . $path;
                break;
        }
        return $share_link;
    }
}

if (!function_exists('livejob')) {

    function livejob()
    {
        $livejobs = Job::where('status', 'active')->count();
        return $livejobs;
    }
}

if (!function_exists('companies')) {

    function companies()
    {
        $companies = Company::count();
        return $companies;
    }
}

if (!function_exists('newjob')) {

    function newjob()
    {
        $newjobs = Job::where('status', 'active')->where('created_at', '>=', Carbon::now()->subDays(7)->toDateString())->count();
        return $newjobs;
    }
}

if (!function_exists('candidate')) {

    function candidate()
    {
        $candidates = Candidate::count();
        return $candidates;
    }
}
if (!function_exists('linkActive')) {

    function linkActive($route, $class = 'active')
    {
        return request()->routeIs($route) ? $class : '';
    }
}

if (!function_exists('candidateNotifications')) {

    function candidateNotifications()
    {

        return auth()->user()->notifications()->take(6)->get();
    }
}

if (!function_exists('candidateNotificationsCount')) {

    function candidateNotificationsCount()
    {

        return auth()->user()->notifications()->count();
    }
}

if (!function_exists('candidateUnreadNotifications')) {

    function candidateUnreadNotifications()
    {
        return auth()->user()->unreadNotifications()->count();
    }
}

if (!function_exists('companyNotifications')) {

    function companyNotifications()
    {

        return auth()->user()->notifications()->take(6)->get();
    }
}

if (!function_exists('companyNotificationsCount')) {

    function companyNotificationsCount()
    {

        return auth()->user()->notifications()->count();
    }
}

if (!function_exists('companyUnreadNotifications')) {

    function companyUnreadNotifications()
    {

        return auth()->user()->unreadNotifications()->count();
    }
}

if (!function_exists('defaultCurrencySymbol')) {

    function defaultCurrencySymbol()
    {

        return config('zakirsoft.app_currency_symbol');
    }
}

if (!function_exists('currencyPosition')) {

    function currencyPosition($amount)
    {
        $symbol = config('jobpilot.currency_symbol');
        $position = config('jobpilot.currency_position');

        if ($position == 'left') {
            return $symbol . ' ' . $amount;
        } else {
            return $amount . ' ' . $symbol;
        }

        return $amount;
    }
}

if (!function_exists('currencyConversion')) {

    function currencyConversion($amount, $from = null, $to = null, $round = 2)
    {
        $from = $from ?? config('zakirsoft.currency');
        $to = $to ?? 'USD';

        return Currency::convert()
            ->from($from)
            ->to($to)
            ->amount($amount)
            ->round($round)
            ->get();
    }
}

if (!function_exists('currentLanguage')) {

    function currentLanguage()
    {
        return session('current_lang');

    }
}

if (!function_exists('langDirection')) {

    function langDirection()
    {
        return session('current_lang')->direction ?? Language::where('code', config('zakirsoft.default_language'))->value('direction');
    }
}

if (!function_exists('metaData')) {

    function metaData($page)
    {
        return Seo::where('page_slug', $page)->first();
    }
}

if (!function_exists('storePlanInformation')) {

    function storePlanInformation()
    {
        session()->forget('user_plan');
        session(['user_plan' => auth('user')->user()->company->userPlan]);
    }
}

if (!function_exists('formatTime')) {

    function formatTime($date, $format = 'F d, Y H:i A')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('inspireMe')) {

    function inspireMe()
    {
        Artisan::call('inspire');
        return Artisan::output();
    }
}

if (!function_exists('getUnsplashImage')) {

    function getUnsplashImage()
    {
        $url = "https://source.unsplash.com/random/1920x1280/?park,mountain,ocean,sunset,travel";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $a = curl_exec($ch); // $a will contain all headers

        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        return $url;
    }
}

if (!function_exists('adminNotifications')) {

    function adminNotifications()
    {
        return auth('admin')->user()->notifications()->take(10)->get();
    }
}

if (!function_exists('adminUnNotifications')) {
    function adminUnNotifications()
    {
        return auth('admin')->user()->unreadNotifications()->count();
    }
}

if (!function_exists('checkMailConfig')) {

    function checkMailConfig()
    {
        $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

        !$status ? flashError('Mail not sent for the reason of incomplete mail configuration'): '';
        return $status ? 1 : 0;
    }
}

/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 *
 * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 *
 * @author  maliayas
 */
if (!function_exists('adjustBrightness2')) {

    function adjustBrightness2($hexCode, $adjustPercent)
    {
        $hexCode = ltrim($hexCode, '#');

        if (strlen($hexCode) == 3) {
            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
        }

        $hexCode = array_map('hexdec', str_split($hexCode, 2));

        foreach ($hexCode as &$color) {
            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
            $adjustAmount = ceil($adjustableLimit * $adjustPercent);

            $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
        }

        return '#' . implode($hexCode);
    }
}

if (!function_exists('openJobs')) {

    function openJobs()
    {
        return Job::where('status', 'active')->where('deadline', '>=', Carbon::now()->toDateString())->count();
    }
}

if (!function_exists('updateMap')) {

    function updateMap($data)
    {
        $location = session()->get('location');

        if ($location) {
            $region = array_key_exists("region", $location) ? $location['region'] : '';
            $country = array_key_exists("country", $location) ? $location['country'] : '';
            $address = Str::slug($region . '-' . $country);

            $data->update([
                'address' => $address,
                'neighborhood' => array_key_exists("neighborhood", $location) ? $location['neighborhood'] : '',
                'locality' => array_key_exists("locality", $location) ? $location['locality'] : '',
                'place' => array_key_exists("place", $location) ? $location['place'] : '',
                'district' => array_key_exists("district", $location) ? $location['district'] : '',
                'postcode' => array_key_exists("postcode", $location) ? $location['postcode'] : '',
                'region' => array_key_exists("region", $location) ? $location['region'] : '',
                'country' => array_key_exists("country", $location) ? $location['country'] : '',
                'long' => array_key_exists("lng", $location) ? $location['lng'] : '',
                'lat' => array_key_exists("lat", $location) ? $location['lat'] : '',
            ]);
            session()->forget('location');
        }

        return true;
    }
}

if (!function_exists('selected_country')) {
    function selected_country()
    {
        $selected_country = session()->get('selected_country');
        $country = Country::FindOrFail($selected_country);

        return $country;
    }
}

if (!function_exists('get_file_size')) {
    function get_file_size($file)
    {
        if (file_exists($file)) {
            $file_size = File::size($file) / 1024  / 1024;
            return round($file_size, 4) . ' MB';
        }

        return '0 MB';
    }
}


/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 *
 * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 *
 * @author  maliayas
 */
function adjustBrightness($hexCode, $adjustPercent)
{
    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));

    foreach ($hexCode as &$color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexCode);
}
