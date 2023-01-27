<?php

namespace App\Http\Controllers\Website;

use PDF;
use Carbon\Carbon;
use Faker\Factory;
use App\Models\cms;
use App\Models\Job;
use App\Models\User;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Earning;
use App\Models\JobRole;
use App\Models\JobType;
use App\Models\Setting;
use App\Models\TeamSize;
use App\Models\UserPlan;
use App\Models\Candidate;
use App\Models\Education;
use App\Models\AppliedJob;
use App\Models\Experience;
use App\Models\SalaryType;
use App\Models\SocialLink;
use App\Models\ContactInfo;
use App\Models\JobCategory;
use App\Models\Nationality;
use Illuminate\Support\Str;
use App\Models\IndustryType;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Mail\SendCandidateMail;
use App\Models\ApplicationGroup;
use App\Models\OrganizationType;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use Modules\Location\Entities\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Location\Entities\State;
use Modules\Location\Entities\Country;
use App\Models\CompanyBookmarkCategory;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Admin\NewJobAvailableNotification;
use App\Notifications\Website\Company\JobEditedNotification;
use App\Notifications\Website\Company\JobCreatedNotification;
use App\Notifications\Website\Company\JobDeletedNotification;
use App\Notifications\Website\Company\CandidateBookmarkNotification;

class CompanyController extends Controller
{
    public function dashboard()
    {
        $data['userplan'] = UserPlan::with('plan')->companyData()->firstOrFail();
        $data['openJobCount'] = auth()->user()->company->jobs()->active()->count();
        $data['pendingJobCount'] = auth()->user()->company->jobs()->pending()->count();

        // Recent 4 Jobs
        $data['recentJobs'] = auth()->user()->company->jobs()->latest()->take(4)->with('company.user', 'job_type')->withCount('appliedJobs')->get();
        $data['savedCandidates']  = auth()->user()->company->bookmarkCandidates()->count();

        return view('website.pages.company.dashboard', $data);
    }

    public function myjobs(Request $request)
    {
        $query = auth('user')
            ->user()
            ->company
            ->jobs()->withCount('appliedJobs');

        // status search
        if ($request->has('status') && $request->status != null) {

            $query->where('status', $request->status);
        }

        // status search
        if ($request->has('apply_on') && $request->apply_on != null) {

            $query->where('apply_on', $request->apply_on);
        }

        $myJobs = $query->with('job_type:id,name')->paginate(12);

        foreach ($myJobs as $job) {

            if ($job->days_remaining < 1) {
                $job->update([
                    'status' => 'expired',
                    'deadline' => null
                ]);
            };
        }

        return view('website.pages.company.myjobs', compact('myJobs'));
    }

    public function allNotification()
    {
        $notifications = auth()->user()->notifications()->paginate(20);

        return view('website.pages.company.all-notifications', compact('notifications'));
    }

    public function createJob()
    {
        $data['jobCategories'] = JobCategory::all();
        $data['roles'] = JobRole::all(['id', 'name']);
        $data['experiences'] = Experience::all(['id', 'name']);
        $data['educations'] = Education::all(['id', 'name']);
        $data['job_types'] = JobType::all(['id', 'name']);
        $data['salary_types'] = SalaryType::all(['id', 'name']);

        return view('website.pages.company.postjob', $data);
    }

    public function storeJob(Request $request)
    {
        $location = session()->get('location');
        if (!$location) {

            $request->validate([
                'location' => 'required',
            ]);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id'  => 'required',
            'role_id'  => 'required',
            'experience' => 'required',
            'education'  => 'required',
            'job_type'  => 'required',
            'vacancies'  => 'required',
            'min_salary'  => 'required|numeric',
            'max_salary' => 'required|numeric',
            'salary_type' => 'required',
            'deadline' => 'required|date',
            'description' => 'required',
            'featured' => 'nullable|numeric',
            'is_remote' => 'nullable|numeric',
            'apply_on' => 'required'
        ]);


        if ($request->apply_on === "custom_url") {
            $request->validate([
                "apply_url" =>  'required|url',
            ]);
        }
        if ($request->apply_on === "email") {
            $request->validate([
                "apply_email" =>  'required|email',
            ]);
        }

        $highlight = $request->badge == 'highlight' ? 1 : 0;
        $featured = $request->badge == 'featured' ? 1 : 0;

        // Job Category
        $job_category_request = $request->category_id;
        $job_category = JobCategory::where('id', $job_category_request)->orWhere('name', $job_category_request)->first();

        if (!$job_category) {
            $job_category = JobCategory::where('name', $job_category_request)->first();

            if (!$job_category) {
                $job_category = JobCategory::create(['name' => $job_category_request]);
            }
        }

        // Job Role
        $job_role_request = $request->role_id;
        $job_role = JobRole::where('id', $job_role_request)->orWhere('name', $job_role_request)->first();
        if (!$job_role) {
            $job_role = JobRole::where('name', $job_role_request)->first();

            if (!$job_role) {
                $job_role = JobRole::create(['name' => $job_role_request]);
            }
        }

        // Experience
        $education_request = $request->education;
        $education = Education::where('id', $education_request)->orWhere('name', $education_request)->first();
        if (!$education) {
            $education = Education::where('name', $education_request)->first();

            if (!$education) {
                $education = Education::create(['name' => $education_request]);
            }
        }

        // Education
        $experience_request = $request->experience;
        $experience = Experience::where('id', $experience_request)->orWhere('name', $experience_request)->first();
        if (!$experience) {
            $experience = Experience::where('name', $experience_request)->first();

            if (!$experience) {
                $experience = Experience::create(['name' => $experience_request]);
            }
        }

        $jobCreated = Job::create([
            'title' => $request->title,
            'company_id' => auth('user')->user()->company->id,
            'category_id' => $job_category->id,
            'role_id' => $job_role->id,
            'education_id' => $education->id,
            'experience_id' => $experience->id,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'salary_type_id' => $request->salary_type,
            'deadline' => Carbon::parse($request->deadline)->format('Y-m-d'),
            'job_type_id' => $request->job_type,
            'vacancies' => $request->vacancies,
            'apply_on' => $request->apply_on,
            'apply_email' => $request->apply_email ?? null,
            'apply_url' => $request->apply_url ?? null,
            'description' => $request->description,
            'featured' => $featured,
            'highlight' => $highlight,
            'is_remote' => $request->is_remote ?? 0,
        ]);

        // Location
        updateMap($jobCreated);

        if ($jobCreated) {
            $user_plan = auth('user')->user()->company->userPlan()->first();

            $user_plan->job_limit = $user_plan->job_limit - 1;
            if ($featured) {
                $user_plan->featured_job_limit = $user_plan->featured_job_limit - 1;
            }
            if ($highlight) {
                $user_plan->highlight_job_limit = $user_plan->highlight_job_limit - 1;
            }
            $user_plan->save();

            storePlanInformation();

            Notification::send(auth('user')->user(), new JobCreatedNotification($jobCreated));

            if (checkMailConfig()) {
                // make notification to admins for approved
                $admins = Admin::all();
                foreach ($admins as $admin) {
                    Notification::send($admin, new NewJobAvailableNotification($admin, $jobCreated));
                }
            }
        }

        flashSuccess('Job Created Successfully');
        return redirect()->route('company.job.promote.show', $jobCreated->slug);
    }

    public function showPromoteJob(Job $job)
    {
        return view('website.pages.company.job-created-success', [
            'jobCreated' => $job
        ]);
    }

    public function jobPromote(Job $job)
    {
        if (!auth('user')->check() || auth('user')->user()->role != 'company') {
            return abort(403);
        }

        return view('website.pages.company.promote-job', [
            'jobCreated' => $job
        ]);
    }

    public function promoteJob(Request $request, Job $jobCreated)
    {
        $userplan = auth('user')->user()->company->userplan ?? abort(403);

        if (!auth('user')->check() || auth('user')->user()->role != 'company' || !$userplan) {
            return abort(403);
        }

        if ($request->badge == 'featured') {
            if ($userplan->featured_job_limit) {
                $userplan->featured_job_limit = $userplan->featured_job_limit - 1;
                $userplan->save();
            } else {
                flashError('You have no featured job limit');
                return redirect()->route('website.plan');
            }

            $jobCreated->update([
                'featured' => 1,
                'highlight' => 0,
            ]);
        } else {
            if ($userplan->highlight_job_limit) {
                $userplan->highlight_job_limit = $userplan->highlight_job_limit - 1;
                $userplan->save();
            } else {
                flashError('You have no highlight job limit');
                return redirect()->route('website.plan');
            }

            $jobCreated->update([
                'featured' => 0,
                'highlight' => 1,
            ]);
        }

        flashSuccess('Your Job Promote Successfully');

        return redirect()->route('website.job.details', $jobCreated->slug);
    }

    public function applicationsSync(Request $request)
    {
        $this->validate(request(), [
            'applicationGroups' => ['required', 'array']
        ]);

        foreach ($request->applicationGroups as $applicationGroup) {
            foreach ($applicationGroup['applications'] as $i => $application) {
                $order = $i + 1;

                if ($application['application_group_id'] !== $applicationGroup['id'] || $application['order'] != $order) {
                    $applications = AppliedJob::where('id', $application['id'])
                        ->where('application_group_id', $application['application_group_id'])
                        ->first()->update([
                            'order' => $order,
                            'application_group_id' => $applicationGroup['id'],
                        ]);
                }
            }
        }

        return $request->user()
            ->company
            ->applicationGroups()
            ->with(['applications' => function ($query) {
                $query->with(['candidate' => function ($query) {
                    return $query->select('id', 'user_id', 'profession_id', 'experience_id', 'education_id')
                        ->with('profession:id,name', 'education:id,name', 'experience:id,name', 'user:id,name,username,image');
                }]);
            }])
            ->get();
    }


    public function jobApplications(Request $request)
    {
        $application_groups = auth()->user()
            ->company
            ->applicationGroups()
            ->with(['applications' => function ($query) use ($request) {
                $query->where('job_id', $request->job)->with(['candidate' => function ($query) {
                    return $query->select('id', 'user_id', 'profession_id', 'experience_id', 'education_id')
                        ->with('profession:id,name', 'education:id,name', 'experience:id,name', 'user:id,name,username,image');
                }]);
            }])
            ->get();

        $job = Job::find($request->job, ['id', 'title']);

        return view('website.pages.company.draggable-application', compact('application_groups', 'job'));
    }

    public function bookmarks(Request $request)
    {
        $query = auth('user')->user()->company->bookmarkCandidates();

        if ($request->category != 'all' && $request->has('category') && $request->category != null) {

            $query->wherePivot('category_id', $request->category);
        }
        $bookmarks = $query->with('profession:id,name')->paginate(12);

        $categories = CompanyBookmarkCategory::where('company_id', auth()->user()->company->id)->get(['id', 'name']);

        return view('website.pages.company.bookmark', compact('bookmarks', 'categories'));
    }

    public function companyBookmarkCandidate(Request $request, Candidate $candidate)
    {
        $company = auth('user')->user()->company;

        if ($request->cat) {
            $user_plan = $company->userPlan;

            if (isset($user_plan) && $user_plan->candidate_cv_view_limit <= 0) {
                return response()->json([
                    'message' => 'You have reached your limit for viewing candidate cv. Please upgrade your plan.',
                    'success' => false,
                    'redirect_url' => route('website.plan'),
                ]);
            }

            isset($user_plan) ? $user_plan->decrement('candidate_cv_view_limit') : '';
        }

        $check = $company->bookmarkCandidates()->toggle($candidate->id);

        if ($check['attached'] == [$candidate->id]) {
            DB::table('bookmark_company')->where('company_id', auth('user')->user()->company->id)->where('candidate_id', $candidate->id)->update(['category_id' => $request->cat]);

            // make notification to candidate
            $user = Auth::user('user');
            if ($candidate->user->shortlisted_alert) {
                Notification::send($candidate->user, new CandidateBookmarkNotification($user, $candidate));
            }
            // notify to company
            Notification::send(auth()->user(), new CandidateBookmarkNotification($user, $candidate));

            flashSuccess('Candidate added to bookmark list');
        }else{
            flashSuccess('Candidate removed from bookmark list');
        }

        return back();
    }

    public function setting()
    {
        $data['user'] = User::with('company', 'contactInfo', 'socialInfo')->findOrFail(auth('user')->id());
        $data['socials'] = $data['user']->socialInfo;
        $data['contact'] = $data['user']->contactInfo;
        $data['organization_types'] = OrganizationType::all();
        $data['industry_types'] = IndustryType::all();
        $data['team_sizes'] = TeamSize::all();
        $data['nationalities'] = Nationality::all();

        return view('website.pages.company.setting', $data);
    }


    public function getStateList(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function getCityList(Request $request)
    {

        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }

    public function settingUpdateInformaton(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $request->session()->put('type', $request->type);

        if ($request->type == "personal") {
            $this->personalUpdate($request, $user);
            flashSuccess('Profile Updated');
            return back();
        }

        if ($request->type == "profile") {
            $this->profileUpdate($request);
            flashSuccess('Profile Updated');
            return back();
        }

        if ($request->type == "social") {

            $this->socialUpdate($request);
            flashSuccess('Profile Updated');
            return back();
        }

        if ($request->type == "contact") {

            $this->contactUpdate($request);
            flashSuccess('Profile Updated');
            return back();
        }

        if ($request->type == 'password') {
            $this->passwordUpdate($request, $user);
            flashSuccess('Profile Updated');
            return back();
        }

        if ($request->type == 'account-delete') {
            $this->accountDelete($user);
            flashSuccess('Profile Updated');
            return back();
        }

        flashSuccess('Company updated!');
        return back();
    }

    public function accountDelete($user)
    {
        $user->delete();
        return true;
    }

    public function personalUpdate($request, $user)
    {
        $request->validate([
            'name' => 'required|unique:users,name,' . auth()->id(),
        ]);

        $company = Company::where('user_id', auth()->id())->first();

        if ($request->image) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            deleteImage($user->company->logo);
            $path = 'images/company';
            $image = uploadImage($request->image, $path);

            if ($company) {
                $company->update([
                    'logo' => $image,
                ]);
            }
        }

        if ($request->banner) {
            $request->validate([
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            deleteImage($user->company->banner);
            $path = 'images/company';
            $banner = uploadImage($request->banner, $path);

            if ($company) {
                $company->update([
                    'banner' => $banner,
                ]);
            }
        }

        $user->update([
            'name' => $request->name,
            'username' => Str::slug($request->name)
        ]);

        if ($company) {
            $company->update([
                'bio' => $request->about_us
            ]);
        }

        return true;
    }

    public function profileUpdate($request)
    {
        $request->validate([
            'organization_type' => 'required',
            'industry_type' => 'required',
            'team_size' => 'required',
            'establishment_date' => 'nullable|date',
        ]);

        $company = Company::where('user_id', auth()->id())->first();

        // Organization Type
        $organization_request = $request->organization_type;
        $organization_type = OrganizationType::where('id', $organization_request)->orWhere('name', $organization_request)->first();

        if (!$organization_type) {
            $organization_type = OrganizationType::create(['name' => $organization_request]);
        }

        // Industry Type
        $industry_request = $request->industry_type;
        $industry_type = IndustryType::where('id', $industry_request)->orWhere('name', $industry_request)->first();

        if (!$industry_type) {
            $industry_type = IndustryType::create(['name' => $industry_request]);
        }

        if ($company) {
            $company->update([
                'organization_type_id' => $organization_type->id,
                'industry_type_id' => $industry_type->id,
                'team_size_id' => $request->team_size,
                'establishment_date' => $request->establishment_date ?? null,
                'website' => $request->website,
                'vision' => $request->vision,
            ]);
        }

        return true;
    }

    public function socialUpdate($request)
    {
        $user = User::find(auth()->id());

        $user->socialInfo()->delete();

        $social_medias = $request->social_media;
        $urls = $request->url;

        if ($social_medias && $urls) {
            foreach ($social_medias as $key => $value) {
                if ($value && $urls[$key]) {
                    $user->socialInfo()->create([
                        'social_media' => $value,
                        'url' => $urls[$key],
                    ]);
                }
            }
        }
        return true;
    }

    public function contactUpdate($request)
    {
        $contact = ContactInfo::where('user_id', auth()->id())->first();
        if (empty($contact)) {
            ContactInfo::create([
                'user_id' => auth()->id(),
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        } else {
            $contact->update([
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        }
        // =========== Location ===========
        updateMap(auth()->user()->company);

        return true;
    }

    public function passwordUpdate($request, $user)
    {

        $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        auth()->logout();

        return true;
    }

    public function settingUpdateContactInformaton(Request $request)
    {
        $request->validate([
            'country_id' => 'required|integer',
            'address' => 'nullable',
            'map_address' => 'nullable',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email'

        ]);

        $user = User::findOrFail(auth()->user()->id);
        $contactUpdate = ContactInfo::where('user_id', $user->id)->update([
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'map_address' => $request->map_address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        $contactUpdate ? flashSuccess('Contact Info updated!') : flashError('Something went wrong!');
        return back();
    }

    public function settingUpdateSocialMedia(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'google' => 'nullable|url'
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $socialLinksUpdate = SocialLink::where('user_id', $user->id)->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'google' => $request->google
        ]);

        $socialLinksUpdate ? flashSuccess('Social Media Links updated!') : flashError('Something went wrong!');
        return back();
    }

    public function destroyApplication(Job $job, Request $request)
    {
        $detached = $job->appliedJobs()->detach($request->candidate_id);
        $detached ? flashSuccess('Application removed from our system.') : flashError('Something went wrong!');
        return back();
    }

    public function plan()
    {
        $userplan = UserPlan::with('plan')->companyData()->firstOrFail();
        $transactions = Earning::with('plan:id,label', 'manualPayment:id,name')->companyData()->latest()->paginate(6);
        return view('website.pages.company.plan', compact('userplan', 'transactions'));
    }

    public function downloadTransactionInvoice(Earning $transaction)
    {
        $data['transaction'] = $transaction->load('plan', 'company.user.contactInfo');

        $data['logo'] = Setting::first()->dark_logo_url;

        $pdf = PDF::loadView('website.pages.company.invoice', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download("invoice_" . $transaction->order_id . ".pdf");
    }

    public function accountProgress()
    {
        $data['user'] = User::with('company', 'contactInfo', 'socialInfo')->findOrFail(auth()->user()->id);
        $data['countries'] = Country::all();
        $data['industry_types'] = IndustryType::all();
        $data['organization_types'] = OrganizationType::all();
        $data['team_sizes'] = TeamSize::all();
        $data['nationalities'] = Nationality::all();
        $title = cms::first()->account_setup_title;
        $subtitle = cms::first()->account_setup_subtitle;
        $data['title'] = $title;
        $data['subtitle'] = $subtitle;
        $data['socials'] = $data['user']->socialInfo;

        if (request()->has('complete')) {
            return view('website.pages.company.account-progress.complete', compact('title', 'subtitle'));
        }


        return view('website.pages.company.account-progress', $data);
    }

    public function profileCompleteProgress(Request $request)
    {
        $company = auth('user')->user()->company;

        switch ($request->field) {
            case "personal":
                $image_validation = $company->logo ? 'sometimes|image|mimes:jpeg,png,jpg|max:2048' :  "required|image|mimes:jpeg,png,jpg|max:2048";
                $banner_validation = $company->banner ? 'sometimes|image|mimes:jpeg,png,jpg|max:5120' :  "required|image|mimes:jpeg,png,jpg|max:5120";

                $request->validate([
                    'image' =>  $image_validation,
                    'banner' =>  $banner_validation,
                    'name' => 'nullable|max:255',
                    'bio' => 'required'
                ], [
                    'image.required' => 'The logo field is required.'
                ]);

                $update = $this->personalProfileUpdate($request);
                if ($update) {
                    return redirect('company/account-progress?profile');
                }
                return back();
                break;
            case "profile":
                $request->validate([
                    'organization_type_id' =>  'required|string',
                    'industry_type_id' =>  'required|string',
                    'establishment_date' => 'nullable',
                    'website' => 'nullable|url',
                    'vision' => 'required'
                ]);

                $update = $this->companyProfileUpdate($request);
                if ($update) {
                    return redirect('company/account-progress?social');
                }
                return back();
                break;
            case "social":
                $request->validate([
                    'facebook' => 'nullable|url',
                    'twitter' => 'nullable|url',
                    'instagram' => 'nullable|url',
                    'linkedin' => 'nullable|url',
                    'youtube' => 'nullable|url',
                ]);

                $update = $this->socialProfileUpdate($request);
                if ($update) {
                    return redirect('company/account-progress?contact');
                }
                return back();
                break;
            case "contact":

                $location = session()->get('location');
                if (!$location) {
                    $request->validate([
                        'location' => 'required',
                    ]);
                }

                $request->validate([
                    'phone' => 'required|max:16|min:4',
                    'email' => 'required|email',
                ]);

                $update = $this->contactProfileUpdate($request);
                if ($update) {
                    return redirect('company/account-progress?complete');
                }
                return back();
                break;
            case "complete":
                return view('website.pages.company.account-progress.complete');
                break;
            default:
                return back();
        }
    }

    public function personalProfileUpdate($request)
    {
        $faker = Factory::create();

        $user = User::findOrFail(auth()->user()->id);
        $company = Company::where('user_id', $user->id)->firstOrFail();

        $user->update([
            'name' => $request->name ?? $faker->name(),
        ]);

        if ($request->hasFile('image')) {
            $image = uploadImage($request->image, 'images/company');
            $company->logo = $image;
        }
        if ($request->hasFile('banner')) {
            $banner = uploadImage($request->banner, 'images/company');
            $company->banner = $banner;
        }

        $company->bio = $request->bio;
        $company->save();

        return true;
    }

    public function makeJobExpire(Job $job)
    {

        $job->update([
            'status' => 'expired',
            'deadline' => null
        ]);

        flashSuccess('Job Status Now Expire');
        return back();
    }

    public function companyProfileUpdate($request)
    {
        // Organization Type
        $organization_request = $request->organization_type_id;
        $organization_type = OrganizationType::where('id', $organization_request)->orWhere('name', $organization_request)->first();

        if (!$organization_type) {
            $organization_type = OrganizationType::create(['name' => $organization_request]);
        }

        // Industry Type
        $industry_request = $request->industry_type_id;
        $industry_type = IndustryType::where('id', $industry_request)->orWhere('name', $industry_request)->first();

        if (!$industry_type) {
            $industry_type = IndustryType::create(['name' => $industry_request]);
        }

        $company = Company::where('user_id', auth()->user()->id);
        $company->update([
            'organization_type_id' => $organization_type->id,
            'industry_type_id' => $industry_type->id,
            'establishment_date' => $request->establishment_date ? date('Y-m-d', strtotime($request->establishment_date)):null,
            'team_size_id' => $request->team_size_id,
            'website' => $request->website,
            'vision' => $request->vision
        ]);

        return $company;
    }

    public function socialProfileUpdate($request)
    {
        $social_medias = $request->social_media;
        $urls = $request->url;

        $user = User::find(auth()->id());
        $user->socialInfo()->delete();

        if ($social_medias && $urls) {

            foreach ($social_medias as $key => $value) {
                if ($value && $urls[$key]) {
                    $user->socialInfo()->create([
                        'social_media' => $value,
                        'url' => $urls[$key],
                    ]);
                }
            }
        }

        return true;
    }

    public function bookmarkCategories(Request $request)
    {
        $query = CompanyBookmarkCategory::where('company_id', auth()->user()->company->id);
        $categories = $query->simplePaginate(12);
        $dataCount = CompanyBookmarkCategory::where('company_id', auth()->user()->company->id)->count();

        if ($request->ajax) {
            return response()->json($query->get());
        }
        return view('website.pages.company.bookmark-category', compact('categories', 'dataCount'));
    }

    public function bookmarkCategoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required| min:2'
        ]);

        CompanyBookmarkCategory::create([

            'company_id' => auth()->user()->company->id,
            'name' => $request->name
        ]);

        flashSuccess('Category Created');
        return back();
    }

    public function bookmarkCategoriesEdit(CompanyBookmarkCategory $category)
    {

        $categories = CompanyBookmarkCategory::where('company_id', auth()->user()->company->id)->simplePaginate(12);
        $dataCount = CompanyBookmarkCategory::where('company_id', auth()->user()->company->id)->count();

        return view('website.pages.company.bookmark-category', compact('categories', 'dataCount', 'category'));
    }

    public function bookmarkCategoriesUpdate(Request $request, CompanyBookmarkCategory $category)
    {

        $category->update([
            'name' => $request->name
        ]);

        flashSuccess('Category Updated');
        return back();
    }

    public function bookmarkCategoriesDestroy(CompanyBookmarkCategory $category)
    {

        $category->delete();

        flashSuccess('Category Deleted');
        return back();
    }

    public function contactProfileUpdate($request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $contact = ContactInfo::where('user_id', $user->id)->update($request->except('_method', '_token', 'field'));

        // =========== Location ===========
        updateMap($user->company());

        if ($contact) {
            Company::where('user_id', $user->id)->update([
                'profile_completion' => 1
            ]);

            return $contact;
        }

        return false;
    }

    public function sendEmailCandidate(Request $request)
    {
        if (!$request->subject || !$request->body) {
            flashError('Please fill all required fields');
            return back();
        }

        if (!checkMailConfig()) {
            flashError('Please configure your mail setting first');
            return back();
        }

        $user = User::whereUsername($request->username)->firstOrFail();

        Mail::to($user->email)->send(new SendCandidateMail($user->name, $request->subject, $request->body));

        flashSuccess('Email Sent');
        return back();
    }

    public function jobClone(Job $job)
    {
        $user = auth('user')->user();
        $user_plan = $user->company->userPlan;

        if (!$user_plan->job_limit) {
            session()->flash('error', 'You have reached your plan limit. Please upgrade your plan.');
            return redirect()->route('company.plan');
        }

        $newJob = $job->replicate();
        $newJob->created_at = now();

        if ($job->featured && $user_plan->featured_job_limit) {
            $newJob->featured = 1;
            $user_plan->featured_job_limit = $user_plan->featured_job_limit - 1;
        } else {
            $newJob->featured = 0;
        }

        if ($job->highlight && $user_plan->highlight_job_limit) {
            $newJob->highlight = 1;
            $user_plan->highlight_job_limit = $user_plan->highlight_job_limit - 1;
        } else {
            $newJob->highlight = 0;
        }

        $newJob->save();
        $user_plan->job_limit = $user_plan->job_limit - 1;
        $user_plan->save();

        storePlanInformation();

        flashSuccess('Job Cloned');
        return back();
    }

    public function applicationColumnStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        ApplicationGroup::create([
            'company_id' => auth()->user()->company->id,
            'name' => $request->name,
        ]);

        flashSuccess('Group Created');
        return response()->json(['success' => true]);
    }

    public function applicationColumnUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        ApplicationGroup::find($request->id)->update([
            'name' => $request->name,
        ]);

        flashSuccess('Group Updated');
        return response()->json(['success' => true]);
    }

    public function applicationColumnDelete(ApplicationGroup $group)
    {
        if ($group->is_deleteable) {
            $new_group = ApplicationGroup::where('company_id', auth()->user()->company->id)
                ->where('id', '!=', $group->id)
                ->where('is_deleteable', false)
                ->first();

            if ($new_group) {
                $group->applications()->update([
                    'application_group_id' => $new_group->id
                ]);
            }

            $group->delete();

            response()->json(['success' => true, 'message' => 'Group Deleted']);
        }

        response()->json(['success' => false, 'message' => 'Group is not deletable']);
    }
}
