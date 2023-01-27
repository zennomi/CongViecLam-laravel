<?php

namespace App\Http\Controllers\Website;

use Carbon\Carbon;
use App\Models\Cms;
use App\Models\Job;
use App\Models\User;
use AmrShawky\Currency;
use App\Models\Company;
use App\Models\JobRole;
use App\Models\Setting;
use App\Models\Candidate;
use App\Models\Education;
use App\Models\CmsContent;
use App\Models\Experience;
use App\Models\Profession;
use App\Models\JobCategory;
use Illuminate\Support\Str;
use App\Http\Traits\Jobable;
use App\Models\IndustryType;
use Illuminate\Http\Request;
use App\Models\ManualPayment;
use App\Models\PaymentSetting;
use App\Models\CandidateResume;
use Modules\Blog\Entities\Post;
use Modules\Plan\Entities\Plan;
use App\Models\OrganizationType;
use App\Http\Traits\Candidateable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Faq\Entities\FaqCategory;
use Modules\Blog\Entities\PostComment;
use Modules\Location\Entities\Country;
use Modules\Blog\Entities\PostCategory;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Notification;
use Modules\Testimonial\Entities\Testimonial;
use App\Services\Midtrans\CreateSnapTokenService;
use App\Notifications\Website\Candidate\ApplyJobNotification;
use App\Notifications\Website\Candidate\BookmarkJobNotification;

class WebsiteController extends Controller
{
    use Jobable, Candidateable;

    public function dashboard()
    {
        if (auth('user')->check() && auth('user')->user()->role == 'candidate') {
            return redirect()->route('candidate.dashboard');
        } elseif (auth('user')->check() && auth('user')->user()->role == 'company') {
            storePlanInformation();
            return redirect()->route('company.dashboard');
        }

        return redirect('login');
    }

    public function notificationRead()
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return response()->json(true);
    }

    public function index()
    {
        $data['livejobs'] = Job::openPosition()->count();
        $data['newjobs'] = Job::newJobs()->count();
        $data['companies'] = Company::count();
        $data['candidates'] = Candidate::count();
        $data['testimonials'] = Testimonial::all();
        $data['top_companies'] = Company::with('user.contactInfo')->withCount('jobs')->latest('jobs_count')->get()->take(9);


        // Featured Jobs With Single && Multiple Country Base
        $featured_jobs_query = Job::query()->with('company', 'job_type:id,name')->withCount([
            'bookmarkJobs', 'appliedJobs',
            'bookmarkJobs as bookmarked' => function ($q) {
                $q->where('candidate_id',  auth('user')->check() && auth('user')->user()->candidate ? auth('user')->user()->candidate->id : '');
            }, 'appliedJobs as applied' => function ($q) {
                $q->where('candidate_id',  auth('user')->check() && auth('user')->user()->candidate ? auth('user')->user()->candidate->id : '');
            }
        ]);
        $setting = Setting::first();
        if ($setting->app_country_type == 'single_base') {
            if ($setting->app_country) {

                $country = Country::where('id', $setting->app_country)->first();
                if ($country) {
                    $featured_jobs_query->where('country', 'LIKE', "%$country->name%");
                }
            }
        } else {
            $selected_country = session()->get('selected_country');

            if ($selected_country && $selected_country != null) {
                $country = selected_country()->name;
                $featured_jobs_query->where('country', 'LIKE', "%$country%");
            }
        }
        $data['featured_jobs'] = $featured_jobs_query->where('featured', 1)->active()->get()->take(6);
        // Featured Jobs With Single && Multiple Country Base END

        $data['popular_categories'] = JobCategory::withCount('jobs')->latest('jobs_count')->get()->take(8);

        $data['popular_roles'] = JobRole::withCount('jobs')->latest('jobs_count')->take(8)->get()->map(function ($role) {
            $role->open_position_count = $role->jobs()->openPosition()->count();
            return $role;
        })->sortBy('open_position_count');
        $data['top_categories'] = JobCategory::withCount('jobs')->latest('jobs_count')->get()->take(4);

        if (auth('user')->check() && auth('user')->user()->role == 'candidate') {
            $data['resumes'] = auth('user')->user()->candidate->resumes;
        } else {
            $data['resumes'] = [];
        }

        return view('website.pages.index', $data);
    }

    public function termsCondition()
    {
        $termscondition = Cms::select('terms_page')->first();
        $cms_content = CmsContent::query();

        $terms_page = null;

        //check session current language
        $current_language = currentLanguage() ? currentLanguage() : '';
        if ($current_language) {

            $exist_cms_content =  $cms_content->where('translation_code', $current_language->code)->where('page_slug', 'terms_condition_page')->first();

            if ($exist_cms_content) {
                $terms_page = $exist_cms_content->text;
            }
        } else { //else push default one

            $exist_cms_content_en =  $cms_content->where('translation_code', 'en')->where('page_slug', 'terms_condition_page')->first();

            if ($exist_cms_content_en) {

                $terms_page = $exist_cms_content_en->text;

            } else {

                $terms_page = $termscondition->terms_page;
            }
        }

        return view('website.pages.terms-condition', compact('termscondition', 'terms_page'));
    }

    public function privacyPolicy()
    {
        $privacy_page_default = Cms::select('privary_page')->first();
        $cms_content = CmsContent::query();

        $privacy_page = null;

        //check session current language
        $current_language = currentLanguage() ? currentLanguage() : '';

        //if has session current language
        if ($current_language) {

            $exist_cms_content =  $cms_content->where('translation_code', $current_language->code)->where('page_slug', 'privacy_page')->first();

            if ($exist_cms_content) {
                $privacy_page = $exist_cms_content->text;
            }
        } else { //else push default one

            $exist_cms_content_en =  $cms_content->where('translation_code', 'en')->where('page_slug', 'privacy_page')->first();

            if ($exist_cms_content_en) {

                $privacy_page = $exist_cms_content_en->text;
            } else {

                $privacy_page = $privacy_page_default->privary_page;
            }
        }

        return view('website.pages.privacy-policy', compact('privacy_page_default', 'privacy_page'));
    }

    public function jobs(Request $request)
    {
        $data = $this->getJobs($request);
        $data['indeed_jobs'] = $this->getIndeedJobs($request);
        $data['careerjet_jobs'] = $this->getCareerjetJobs($request);

        if (auth('user')->check() && auth('user')->user()->role == 'candidate') {
            $data['resumes'] = auth('user')->user()->candidate->resumes;
        } else {
            $data['resumes'] = [];
        }

        return view('website.pages.jobs', $data);
    }

    public function jobDetails(Job $job)
    {
        // return auth('user')->user()->candidate->resumes;
        if ($job->status == 'pending') {
            if (!auth('admin')->check()) {
                abort_if(!auth('user')->check(), 404);
                abort_if(auth('user')->user()->role != 'company', 404);
                abort_if(auth('user')->user()->company->id != $job->company_id, 404);
            }
        }

        $data = $this->getJobDetails($job);

        return view('website.pages.job-details', $data);
    }

    public function candidates(Request $request)
    {
        abort_if(auth('user')->check() && auth('user')->user()->role == 'candidate', 404);

        $data['professions'] = Profession::all();
        $data['candidates'] = $this->getCandidates($request);
        $data['countries'] = Country::all();
        $data['experiences'] = Experience::all();
        $data['educations'] = Education::all();

        return view('website.pages.candidates', $data);
    }

    public function candidateDetails(Request $request, $username)
    {
        $candidate = User::where('username', $username)
            ->with('candidate', 'contactInfo', 'socialInfo')
            ->firstOrFail();

        abort_if(auth('user')->check() && $candidate->id != auth('user')->id(), 404);

        if ($request->ajax) {
            return response()->json($candidate);
        }

        return view('website.pages.candidate-details', compact('candidate'));
    }

    public function candidateProfileDetails(Request $request)
    {
        $user = auth('user')->user();

        if ($user->role != 'company') {
            return response()->json([
                'message' => 'You are not authorized to perform this action.',
                'success' => false
            ]);
        } else {
            $user_plan = $user->company->userPlan;
        }

        if (isset($user_plan) && $user_plan->candidate_cv_view_limit <= 0) {
            return response()->json([
                'message' => 'You have reached your limit for viewing candidate cv. Please upgrade your plan.',
                'success' => false,
                'redirect_url' => route('website.plan'),
            ]);
        }

        $candidate = User::where('username', $request->username)
            ->with(['contactInfo', 'socialInfo', 'candidate' => function ($query) {
                $query->with('experience', 'education', 'profession', 'nationality:id,name')->withCount(['bookmarkCandidates as bookmarked' => function ($q) {
                    $q->where('company_id',  auth('user')->user()->company->id);
                }]);
            }])
            ->firstOrFail();

        $candidate->candidate->birth_date = Carbon::parse($candidate->candidate->birth_date)->format('d F, Y');

        if ($request->count_view) {
            isset($user_plan) ? $user_plan->decrement('candidate_cv_view_limit') : '';
        }

        return response()->json([
            'success' => true,
            'data' => $candidate,
            'profile_view_limit' => 'You have ' . $user_plan->candidate_cv_view_limit . ' cv views remaining.',
        ]);
    }

    public function candidateApplicationProfileDetails(Request $request)
    {
        $candidate = User::where('username', $request->username)
            ->with(['contactInfo', 'socialInfo', 'candidate' => function ($query) {
                $query->with('experience', 'education', 'profession', 'nationality');
            }])
            ->firstOrFail();

        $candidate->candidate->birth_date = Carbon::parse($candidate->candidate->birth_date)->format('d F, Y');

        return response()->json([
            'success' => true,
            'data' => $candidate,
        ]);
    }

    public function candidateDownloadCv(CandidateResume $resume)
    {
        $filePath = $resume->file;

        $filename = time() . '.pdf';

        $headers = ['Content-Type: application/pdf',  'filename' => $filename,];
        $fileName = rand() . '-resume' . '.pdf';

        return response()->download($filePath, $fileName, $headers);
    }

    public function employees(Request $request)
    {
        abort_if(auth('user')->check() && auth('user')->user()->role == 'company', 404);

        $query = Company::with('user', 'user.contactInfo')->withCount([
            'jobs as activejobs' => function ($q) {
                $q->where('status', 'active');
            }
        ])->withCount([
            'bookmarkCandidateCompany as candidatemarked' => function ($q) {
                $q->where('user_id', auth()->id());
            }
        ])
            ->withCasts(['candidatemarked' => 'boolean'])->active();

        // Keyword search
        if ($request->has('keyword') && $request->keyword != null) {
            $keyword = $request->keyword;
            $query->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%$keyword%");
            });
        }

        // location search
        if ($request->has('lat') && $request->has('long') && $request->lat != null && $request->long != null) {

            $ids = $this->company_location_filter($request->lat, $request->long);
            $query->whereIn('id', $ids);
        }

        // industry_type
        if ($request->has('industry_type') && $request->industry_type !== null) {
            $industry_type_id = IndustryType::where('name', $request->industry_type)->value('id');
            $query->where('industry_type_id', $industry_type_id);
        }

        // organization_type
        if ($request->has('organization_type') && $request->organization_type !== null) {

            $organization_type = $request->organization_type;

            $query->whereHas('organization', function ($q) use ($organization_type) {
                $q->where('name', $organization_type);
            });
        }
        // sortBy search
        if ($request->has('sortBy') && $request->sortBy) {
            if ($request->sortBy == 'latest') {
                $query->latest();
            } else {
                $query->oldest();
            }
        } else {
            $query->latest();
        }

        $companies = $query;

        // perpage filter
        if ($request->has('perpage') && $request->perpage != null) {
            switch ($request->perpage) {
                case '12':
                    $companies = $query->latest('activejobs')->paginate(12);
                    break;
                case '18':
                    $companies = $query->latest('activejobs')->paginate(18);
                    break;
                case '30':
                    $companies = $query->latest('activejobs')->paginate(30);
                    break;
            }
        } else {
            $companies = $query->latest('activejobs')->paginate(12);
        }

        $industry_types = IndustryType::all();
        $organization_type = OrganizationType::all();

        // return $companies;

        return view('website.pages.employees', compact('companies', 'industry_types', 'organization_type'));
    }

    public function employersDetails(User $user)
    {
        $companyDetails =  Company::with(
            'organization:id,name',
            'industry:id,name',
            'team_size:id,name',
        )->where('user_id', $user->id)->withCount([
            'jobs as activejobs' => function ($q) {
                $q->where('status', true);
                $q->where('deadline', '>=', Carbon::now()->toDateString());
            }
        ])
            ->withCount([
                'bookmarkCandidateCompany as candidatemarked' => function ($q) {
                    $q->where('user_id', auth()->id());
                }
            ])
            ->withCasts(['candidatemarked' => 'boolean'])
            ->first();

        // open_jobs Jobs With Single && Multiple Country Base
        $open_jobs_query = Job::with('company');

        $setting = Setting::first();
        if ($setting->app_country_type == 'single_base') {
            if ($setting->app_country) {

                $country = Country::where('id', $setting->app_country)->first();
                if ($country) {
                    $open_jobs_query->where('country', 'LIKE', "%$country->name%");
                }
            }
        } else {
            $selected_country = session()->get('selected_country');

            if ($selected_country && $selected_country != null) {
                $country = selected_country()->name;
                $open_jobs_query->where('country', 'LIKE', "%$country%");
            }
        }
        $open_jobs = $open_jobs_query->companyJobs($companyDetails->id)->openPosition()->latest()->get();
        // Related Jobs With Single && Multiple Country Base END

        // return $companyDetails;

        return view('website.pages.employe-details', compact('user', 'companyDetails', 'open_jobs'));
    }

    public function about()
    {
        $testimonials = Testimonial::all();
        $livejobs = Job::where('status', 1)->count();
        $companies = Company::count();
        $candidates = Candidate::count();
        $about = Cms::first();

        return view('website.pages.about', compact('testimonials', 'livejobs', 'companies', 'candidates', 'about'));
    }

    public function categoryWisePosts(PostCategory $category)
    {
        $key = request()->search;
        $key = request()->category;

        $posts = Post::query();

        if ($key) {
            $posts->where('title', 'Like', '%' . $key . '%');
        }

        $posts = $category->posts()->latest()->paginate(15);

        $recent_posts = Post::latest()->take(5)->get();
        $categories = PostCategory::latest()->get();
        return view('website.pages.posts', compact('posts', 'categories', 'recent_posts', 'key'));
    }

    public function pricing()
    {
        abort_if(auth('user')->check() && auth('user')->user()->role == 'candidate', 404);
        $plans = Plan::active()->get();
        return view('website.pages.pricing', compact('plans'));
    }

    public function planDetails($label)
    {
        abort_if(auth('user')->check() && auth('user')->user()->role == 'candidate', 404);

        // session data storing
        $plan = Plan::where('label', $label)->firstOrFail();
        session(['stripe_amount' => currencyConversion($plan->price) * 100]);
        session(['razor_amount' => currencyConversion($plan->price, null, 'INR', 1) * 100]);
        session(['ssl_amount' => currencyConversion($plan->price, null, 'BDT', 1)]);
        session(['plan' => $plan]);

        $payment_setting = PaymentSetting::first();
        $manual_payments = ManualPayment::whereStatus(1)->get();

        // midtrans snap token
        if (config('zakirsoft.midtrans_active') && config('zakirsoft.midtrans_merchat_id') && config('zakirsoft.midtrans_client_key') && config('zakirsoft.midtrans_server_key')) {
            $usd = $plan->price;
            $amount = (int) Currency::convert()
                ->from(config('zakirsoft.currency'))
                ->to('IDR')
                ->amount($usd)
                ->round(2)
                ->get();

            $order['order_no'] = uniqid();
            $order['total_price'] = $amount;

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            session(['midtrans_details' => [
                'order_no' => $order['order_no'],
                'total_price' => $order['total_price'],
                'snap_token' => $snapToken,
                'plan_id' => $plan->id,
            ]]);
        }

        return view('website.pages.plan-details', [
            'plan' => $plan,
            'payment_setting' => $payment_setting,
            'mid_token' => $snapToken ?? null,
            'manual_payments' => $manual_payments,
        ]);
    }

    public function contact()
    {
        return view('website.pages.contact');
    }

    public function faq()
    {
        $faq_categories = FaqCategory::with('faqs')->get();
        return view('website.pages.faq', compact('faq_categories'));
    }

    public function comingSoon()
    {
        return view('website.pages.comingsoon');
    }

    public function toggleBookmarkJob(Job $job)
    {
        $check = $job->bookmarkJobs()->toggle(auth('user')->user()->candidate);

        if ($check['attached'] == [1]) {

            $user = auth('user')->user();
            // make notification to company candidate bookmark job
            Notification::send($job->company->user, new BookmarkJobNotification($user, $job));
            // make notification to candidate for notify
            if (auth()->user()->recent_activities_alert) {
                Notification::send(auth('user')->user(), new BookmarkJobNotification($user, $job));
            }
        }


        $check['attached'] == [1] ? $message = 'Job added to favorite list' : $message = 'Job removed from favorite list';

        flashSuccess($message);
        return back();
    }

    public function toggleApplyJob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resume_id' => 'required',
            'cover_letter' => 'required',
        ], [
            'resume_id.required' => 'Please select resume',
            'cover_letter.required' => 'Please enter cover letter',
        ]);

        if ($validator->fails()) {
            flashError($validator->errors()->first());
            return back();
        }

        if (auth('user')->user()->candidate->profile_complete != 0) {
            flashError('Complete your profile before applying to jobs, Add your information, resume, and profile picture for a better chance of getting hired.');
            return redirect()->route('candidate.dashboard');
        }

        $candidate = auth('user')->user()->candidate;
        $job = Job::find($request->id);

        DB::table('applied_jobs')->insert([
            'candidate_id' => $candidate->id,
            'job_id' => $job->id,
            'cover_letter' => $request->cover_letter,
            'candidate_resume_id' => $request->resume_id,
            'application_group_id' => $job->company->applicationGroups->where('is_deleteable', false)->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // make notification to candidate and company for notify
        $job->company->user->notify(new ApplyJobNotification(auth('user')->user(), $job->company->user));

        if (auth('user')->user()->recent_activities_alert) {
            auth('user')->user()->notify(new ApplyJobNotification(auth('user')->user(), $job->company->user));
        }

        flashSuccess('Job Applied Successfully');
        return back();
    }

    public function register($role)
    {
        return view('auth.register', compact('role'));
    }

    public function posts(Request $request)
    {
        $key = request()->search;
        $posts = Post::query()->withCount('comments');

        if ($key) {
            $posts->where('title', 'Like', '%' . $key . '%');
        }

        if ($request->category) {
            $category_ids = PostCategory::whereIn('slug', $request->category)->get()->pluck('id');
            $posts = $posts->whereIn('category_id', $category_ids)->latest()->paginate(10)->withQueryString();
        } else {
            $posts = $posts->latest()->paginate(10)->withQueryString();
        }

        $recent_posts = Post::withCount('comments')->latest()->take(5)->get();
        $categories = PostCategory::latest()->get();

        return view('website.pages.posts', compact('posts', 'categories', 'recent_posts'));
    }

    public function post($slug)
    {
        $post = Post::whereSlug($slug)
            ->with([
                'author:id,name,name',
                'comments.replies.user:id,name,image'
            ])
            ->first();

        return view('website.pages.post', compact('post'));
    }

    public function comment(Post $post, Request $request)
    {

        $request->validate([
            'body' => 'required|max:2500|min:2'
        ]);

        $comment = new PostComment();
        $comment->author_id = auth()->user()->id;
        $comment->post_id = $post->id;
        if ($request->has('parent_id')) {
            $comment->parent_id = $request->parent_id;
            $redirect = "#replies-" . $request->parent_id;
        } else {
            $redirect = "#comments";
        }
        $comment->body = $request->body;
        $comment->save();

        return redirect(url()->previous() . $redirect);
    }

    public function markReadSingleNotification(Request $request)
    {
        auth()->user()->unreadNotifications->where('id', $request->id)->markAsRead();

        return true;
    }

    public function setSession(Request $request)
    {
        $request->session()->put('location', $request->input());
        return response()->json(true);
    }

    public function setCurrentLocation(Request $request)
    {
        // Current Visitor Location Track && Set Country IF App Is Multi Country Base
        $app_country = setting('app_country_type');

        if ($app_country == 'multiple_base') {

            $ip = request()->ip();
            // $ip = '105.179.161.212';
            // $ip = '246.134.118.218';
            // $ip = '197.246.60.160';
            // $ip = '107.29.65.61';

            if ($ip) {
                $current_user_data = Location::get($ip);
            }
            if ($current_user_data) {
                $user_country = $current_user_data->countryName;
                if ($user_country) {
                    $database_country = Country::where('name', $user_country)->where('status', 1)->first();
                    if ($database_country) {
                        $selected_country = session()->get('selected_country');
                        if (!$selected_country) {
                            session()->put('selected_country', $database_country->id);
                            return true;
                        }
                    }
                }
            }
        }
    }

    public function setSelectedCountry(Request $request)
    {
        session()->put('selected_country', $request->country);

        return redirect()->route('website.job');
    }

    public function removeSelectedCountry()
    {
        session()->forget('selected_country');
        return redirect()->back();
    }

    public function company_location_filter($latitude, $longitude)
    {
        $distance = 50;

        $haversine = "(
                    6371 * acos(
                        cos(radians(" . $latitude . "))
                        * cos(radians(`lat`))
                        * cos(radians(`long`) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . ")) * sin(radians(`lat`))
                    )
                )";

        $data = Company::select('id')->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $distance)->get();

        $ids = [];

        foreach ($data as $id) {
            array_push($ids, $id->id);
        }

        return $ids;
    }

    public function jobAutocomplete(Request $request)
    {
        $jobs = Job::select("title as value", "id")
            ->where('title', 'LIKE', '%' . $request->get('search') . '%')
            ->active()
            ->latest()
            ->get()
            ->take(15);

        if ($jobs && count($jobs)) {
            $data = '<ul class="dropdown-menu show">';
            foreach ($jobs as $job) {
                $data .= '<li class="dropdown-item"><a href="' . route('website.job', ['keyword' => $job->value]) . '">' . $job->value . '</a></li>';
            }
            $data .= '</ul>';
        } else {
            $data = '<ul class="dropdown-menu show"><li class="dropdown-item">No data found</li></ul>';
        }

        return response()->json($data);
    }
}
