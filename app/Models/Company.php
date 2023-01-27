<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use App\Models\Earning;
use App\Models\Setting;
use App\Models\UserPlan;
use App\Models\Candidate;
use App\Traits\Socialable;
use Modules\Plan\Entities\Plan;
use Database\Seeders\CompanyBookmarks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Location\Entities\Country;

class Company extends Model
{
    use HasFactory, Socialable;

    protected $guarded = [];

    protected $appends = ['logo_url', 'banner_url', 'full_address'];

    protected $casts = [
        'establishment_date'    =>  'datetime',
        'profile_completion'   =>  'boolean'
    ];

    protected static function booted()
    {
        static::created(function ($company) {
            $setting = Setting::first();
            $plan = Plan::find($setting->default_plan);

            $company->userPlan()->create([
                'plan_id'  =>  $setting->default_plan,
                'job_limit'  =>  $plan->job_limit,
                'featured_job_limit'  =>  $plan->featured_job_limit,
                'highlight_job_limit'  =>  $plan->highlight_job_limit,
                'candidate_cv_view_limit'  =>  $plan->candidate_cv_view_limit,
            ]);


              // Kanban board
              $company->applicationGroups()->createMany([
                [
                    'name' => 'No Group',
                    'order' => 1,
                    'is_deleteable' => false
                ],
                [
                    'name' => 'All Applications',
                    'order' => 1
                ],
                [
                    'name' => 'Shortlisted',
                    'order' => 2
                ],
                [
                    'name' => 'Interview',
                    'order' => 3
                ],
                [
                    'name' => 'Rejected',
                    'order' => 4
                ]
            ]);
        });
    }

    public function getFullAddressAttribute()
    {
        $country = $this->country;
        $region = $this->region;
        $extra = $region != null ? ' , ' : '';
        return $region . $extra . $country;
    }

    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return asset('backend/image/default.png');
        }

        return asset($this->logo);
    }

    public function getBannerUrlAttribute()
    {
        if (!$this->banner) {
            return asset('backend/image/default.png');
        }

        return asset($this->banner);
    }

    public function scopeActive($query)
    {
        return $query->where('visibility', 1)->whereHas('user', function ($q) {
            $q->whereStatus(1);
        });
    }

    public function scopeInactive($query)
    {
        return $query->where('visibility', 0)->whereHas('user', function ($q) {
            $q->whereStatus(0);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function bookmarkCandidates()
    {
        return $this->belongsToMany(Candidate::class, 'bookmark_company')->with('user')->withPivot('category_id')->withTimestamps();
    }

    public function category(): HasOne
    {
        return $this->hasOne(CompanyBookmarkCategory::class, 'company_id');
    }

    public function bookmarkCandidateCompany()
    {
        return $this->belongsToMany(Candidate::class, 'bookmark_candidate_company');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id');
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(IndustryType::class, 'industry_type_id');
    }

    /**
     * User Pricing Plan
     *
     * @return HasOne
     *
     */
    public function userPlan(): HasOne
    {
        return $this->hasOne(UserPlan::class, 'company_id');
    }

    /**
     * User Transactions
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Earning::class);
    }

    public function nationality(): HasOne
    {
        return $this->hasOne(Nationality::class, 'id', 'nationality_id');
    }

    public function rejects()
    {

        return $this->belongsToMany(AppliedJob::class, 'company_applied_job_rejected')->withCount('shortlists')->with('candidate.user');
    }

    public function shortlists()
    {
        return $this->belongsToMany(AppliedJob::class, 'company_applied_job_shortlist')->with('candidate.user');
    }

    public function team_size()
    {
        return $this->belongsTo(TeamSize::class, 'team_size_id', 'id');
    }

    public function applicationGroups()
    {
        return $this->hasMany(ApplicationGroup::class, 'company_id');
    }
}
