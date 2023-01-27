<?php

namespace App\Http\Traits;

use App\Models\Job;
use App\Models\JobRole;
use App\Models\JobType;
use App\Models\Setting;
use App\Models\Education;
use App\Models\Experience;
use App\Models\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Location\Entities\Country;

trait Jobable
{
    private function getJobs($request)
    {
        if (auth()->user()) {

            $query = Job::with('company.user', 'category', 'job_type:id,name')
                ->withCount([
                    'bookmarkJobs', 'appliedJobs',
                    'bookmarkJobs as bookmarked' => function ($q) {
                        $q->where('candidate_id',  auth('user')->user()->candidate ? auth('user')->user()->candidate->id : '');
                    }, 'appliedJobs as applied' => function ($q) {
                        $q->where('candidate_id',  auth('user')->user()->candidate ? auth('user')->user()->candidate->id : '');
                    }
                ])
                ->active();
        } else {

            $query = Job::with('company.user', 'category', 'job_type:id,name')
                ->withCount([
                    'bookmarkJobs', 'appliedJobs',
                    'bookmarkJobs as bookmarked' => function ($q) {
                        $q->where('candidate_id', '');
                    }, 'appliedJobs as applied' => function ($q) {
                        $q->where('candidate_id', '');
                    }
                ])
                ->active();
        }

        // company search
        if ($request->has('company') && $request->company != null) {
            $company = $request->company;
            $query->whereHas('company.user', function ($q) use ($company) {
                $q->where('username', $company);
            });
        }

        // Keyword search
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        // Category filter
        if ($request->has('category') && $request->category != null) {
            $category = $request->category;

            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        // job role filter
        if ($request->has('job_role') && $request->job_role != null) {
            $job_role = $request->job_role;

            $query->whereHas('role', function ($q) use ($job_role) {
                $q->where('name', $job_role);
            });
        }

        // Salery filter
        if ($request->has('price_min') && $request->price_min != null) {
            $query->where('min_salary', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max != null) {
            $query->where('max_salary', '<=', $request->price_max);
        }

        // location
        $final_address = '';
        if ($request->has('location') && $request->location != null) {
            $adress = $request->location;
            if ($adress) {
                $adress_array = explode(" ", $adress);
                if ($adress_array) {
                    $last_two = array_splice($adress_array, -2);
                }
                $final_address = Str::slug(implode(" ", $last_two));
            }
        }
        // lat Long
        if ($request->has('lat') && $request->has('long') && $request->lat != null && $request->long != null) {
            session()->forget('selected_country');
            $ids = $this->location_filter($request);
            $query->whereIn('id', $ids)
                ->orWhere('address', $final_address ? $final_address : '')
                ->orWhere('country', $request->location ? $request->location : '');
        }

        // country
        $selected_country = session()->get('selected_country');

        if ($selected_country && $selected_country != null) {
            $country = selected_country()->name;
            $query->where('country', 'LIKE', "%$country%");
        } else {

            $setting = Setting::first();
            if ($setting->app_country_type == 'single_base') {
                if ($setting->app_country) {

                    $country = Country::where('id', $setting->app_country)->first();
                    if ($country) {
                        $query->where('country', 'LIKE', "%$country->name%");
                    }
                }
            }
        }

        // Sort by ads
        if ($request->has('sort_by') && $request->sort_by != null) {
            switch ($request->sort_by) {
                case 'recommanded':
                    $query;
                    // if (auth('user')->check()) {
                    //     $user_country = auth('user')->user()->country();

                    //     $query->where('country', 'LIKE', "%$user_country%")
                    //         ->orderBy('created_at', 'desc');
                    // }
                    break;
                case 'latest':
                    $query->latest('id');
                    break;
                case 'featured':
                    $query->where('featured', 1)->latest();
                    break;
            }
        }

        // Experience filter
        if ($request->has('experience') && $request->experience != null) {
            $experience_id = Experience::where('name', $request->experience)->value('id');
            $query->where('experience_id', $experience_id);
        }

        // Education filter
        if ($request->has('education') && $request->education != null) {
            $education_id = Education::where('name', $request->education)->value('id');
            $query->where('education_id', $education_id);
        }

        // Work type filter
        if ($request->has('is_remote') && $request->is_remote != null) {
            $query->where('is_remote', 1);
        }

        // Job type filter
        if ($request->has('job_type') && $request->job_type != null) {
            $job_type_id = JobType::where('name', $request->job_type)->value('id');
            $query->where('job_type_id', $job_type_id);
        }

        $jobs = $query->paginate(12)->withQueryString();

        return [
            'total_jobs' => $jobs->total(),
            'jobs' => $jobs,
            'countries' => Country::all(['id', 'name', 'slug']),
            'categories' => JobCategory::all(['id', 'name', 'slug']),
            'job_roles' => JobRole::all(['id', 'name', 'slug']),
            'max_salary' => \DB::table('jobs')->max('max_salary'),
            'min_salary' => \DB::table('jobs')->max('min_salary'),
            'experiences' => Experience::all(),
            'educations' => Education::all(),
            'job_types' => JobType::all(),
        ];
    }

    private function getJobDetails($job)
    {
        if (auth()->user()) {

            $job_details = $job->load(['role:id,name', 'company.user' => function ($q) {
                return $q->with('contactInfo', 'socialInfo');
            }])->loadCount([
                'bookmarkJobs', 'appliedJobs',
                'bookmarkJobs as bookmarked' => function ($q) {
                    $q->where('candidate_id',  auth('user')->user()->candidate ? auth('user')->user()->candidate->id : '');
                }, 'appliedJobs as applied' => function ($q) {
                    $q->where('candidate_id',  auth('user')->user()->candidate ? auth('user')->user()->candidate->id : '');
                }
            ]);
        } else {

            $job_details = $job->load(['role:id,name', 'company.user' => function ($q) {
                return $q->with('contactInfo', 'socialInfo');
            }])->loadCount([
                'bookmarkJobs', 'appliedJobs',
                'bookmarkJobs as bookmarked' => function ($q) {
                    $q->where('candidate_id',  '');
                }, 'appliedJobs as applied' => function ($q) {
                    $q->where('candidate_id',  '');
                }
            ]);
        }

        if (auth()->user()) {

            // Related Jobs With Single && Multiple Country Base
            $related_jobs_query = Job::query()->active()->where('id', '!=', $job->id)->where('category_id', $job->category_id);
            $setting = Setting::first();
            if ($setting->app_country_type == 'single_base') {
                if ($setting->app_country) {

                    $country = Country::where('id', $setting->app_country)->first();
                    if ($country) {
                        $related_jobs_query->where('country', 'LIKE', "%$country->name%");
                    }
                }
            } else {
                $selected_country = session()->get('selected_country');

                if ($selected_country && $selected_country != null) {
                    $country = selected_country()->name;
                    $related_jobs_query->where('country', 'LIKE', "%$country%");
                }
            }
            $related_jobs = $related_jobs_query->latest()->limit(18)
                ->withCount([
                    'bookmarkJobs',
                    'bookmarkJobs as bookmarked' => function ($q) {
                        $q->where('candidate_id',  auth('user')->user()->candidate ? auth('user')->user()->candidate->id : '');
                    }
                ])->get();
            // Related Jobs With Single && Multiple Country Base END

        } else {

            // Related Jobs With Single && Multiple Country Base
            $related_jobs_query = Job::query()->active()->where('id', '!=', $job->id)->where('category_id', $job->category_id);
            $setting = Setting::first();
            if ($setting->app_country_type == 'single_base') {
                if ($setting->app_country) {

                    $country = Country::where('id', $setting->app_country)->first();
                    if ($country) {
                        $related_jobs_query->where('country', 'LIKE', "%$country->name%");
                    }
                }
            } else {
                $selected_country = session()->get('selected_country');

                if ($selected_country && $selected_country != null) {
                    $country = selected_country()->name;
                    $related_jobs_query->where('country', 'LIKE', "%$country%");
                }
            }
            $related_jobs = $related_jobs_query->latest()->limit(18)
                ->withCount([
                    'bookmarkJobs',
                    'bookmarkJobs as bookmarked' => function ($q) {
                        $q->where('candidate_id', '');
                    }
                ])->get();
            // Related Jobs With Single && Multiple Country Base END
        }

        if (auth('user')->check() && auth('user')->user()->role == 'candidate') {
            $resumes = auth('user')->user()->candidate->resumes;
        }else{
            $resumes = [];
        }

        return [
            'job' => $job_details,
            'related_jobs' => $related_jobs,
            'resumes' => $resumes,
        ];
    }

    private function getIndeedJobs(Request $request)
    {
        if (config('zakirsoft.indeed_active') && config('zakirsoft.indeed_id')) {
            $keyword = $request->keyword ?? '';
            $category = $request->category ? JobCategory::whereSlug($request->category)->value('name') : '';
            $role = $request->job_role ? JobRole::whereSlug($request->category)->value('name') : '';
            $keywords = $keyword ? $keyword : ($category ? $category : ($role ? $role : 'job'));

            $q       = $keywords;
            $l       = '';
            $limit   = config('zakirsoft.indeed_limit') ?? 10;
            $start   = '';
            $end     = '';
            $sort    = 'date';
            $jt      = '';
            $fromage = '';
            $radius  = '';
            $data    = array(
                'publisher' => config('zakirsoft.indeed_id'),
                'v' => 2,
                'format' => 'json',
                'q' => $q,
                'l' => $l,
                'jt' => $jt,
                'fromage' => $fromage,
                'limit' => $limit,
                'start' => $start,
                'end' => $end,
                'radius' => $radius,
                'sort' => $sort,
                'highlight' => 1,
                'filter' => 1,
                // 'latlong' => 1,
                // 'co' => 'uk',
                // 'co' => 'United Kingdom'
            );
            $param   = http_build_query($data) . "\n";
            $url     = 'http://api.indeed.com/ads/apisearch?' . $param;

            header('Content-type: application/json');
            $obj = file_get_contents($url);
            $json_decode = json_decode($obj);
            return $json_decode;
        }
    }

    public function getCareerjetJobs(Request $request)
    {
        if (config('zakirsoft.careerjet_active') && config('zakirsoft.careerjet_id')) {
            $keyword = $request->keyword ?? '';
            $category = $request->category ? JobCategory::whereSlug($request->category)->value('name') : '';
            $role = $request->job_role ? JobRole::whereSlug($request->category)->value('name') : '';
            $keywords = $keyword ? $keyword : ($category ? $category : ($role ? $role : 'job'));

            $page = 1;
            $result = $this->search(array(
                'keywords' => $keywords ?? '',
                'location' => '',
                'page' => $page,
                'sort' => 'date',
                'pagesize' => config('zakirsoft.careerjet_limit') ?? 10,
                'affid' => config('zakirsoft.careerjet_id'),
            ));

            return $result;
        }
    }

    function call($fname, $args)
    {
        $locale = config('zakirsoft.careerjet_default_locale');
        $url = 'http://public.api.careerjet.net/' . $fname . '?locale_code=' . $locale;

        if (empty($args['affid'])) {
            return (object) array(
                'type' => 'ERROR',
                'error' => "Your Careerjet affiliate ID needs to be supplied. If you don't " .
                    "have one, open a free Careerjet partner account."
            );
        }

        foreach ($args as $key => $value) {
            $url .= '&' . $key . '=' . urlencode($value);
        }

        if (empty($_SERVER['REMOTE_ADDR'])) {
            return (object) array(
                'type' => 'ERROR',
                'error' => 'not running within a http server'
            );
        }

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // For more info: http://en.wikipedia.org/wiki/X-Forwarded-For
            $ip = trim(array_shift(array_values(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']))));
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $url .= '&user_ip=' . $ip;
        $url .= '&user_agent=' . urlencode($_SERVER['HTTP_USER_AGENT']);

        // determine current page
        $current_page_url = '';
        if (!empty($_SERVER["SERVER_NAME"]) && !empty($_SERVER["REQUEST_URI"])) {
            $current_page_url = 'http';
            if (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
                $current_page_url .= "s";
            }
            $current_page_url .= "://";

            if (!empty($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
                $current_page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            } else {
                $current_page_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            }
        }

        $version = '3.6';
        $header = "User-Agent: careerjet-api-client-v" . $version . "-php-v" . phpversion();
        if ($current_page_url) {
            $header .= "\nReferer: " . $current_page_url;
        }

        header('Content-type: application/json');
        $obj = file_get_contents($url);
        $json_decode = json_decode($obj);
        return $json_decode;
    }

    function search($args)
    {
        $result =  $this->call('search', $args);
        if ($result->type == 'ERROR') {
            trigger_error($result->error);
        }
        return $result;
    }

    public function location_filter($request)
    {
        $latitude = $request->lat;
        $longitude = $request->long;

        if ($request->has('radius') && $request->radius != null) {
            $distance = $request->radius;
        } else {
            $distance = 50;
        }

        $haversine = "(
                    6371 * acos(
                        cos(radians(" . $latitude . "))
                        * cos(radians(`lat`))
                        * cos(radians(`long`) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . ")) * sin(radians(`lat`))
                    )
                )";

        $data = Job::select('id')->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $distance)->get();

        $ids = [];

        foreach ($data as $id) {
            array_push($ids, $id->id);
        }

        return $ids;
    }
}
