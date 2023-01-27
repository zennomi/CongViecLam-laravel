<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\JobCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['days_remaining', 'deadline_active', 'can_apply', 'full_address'];
    protected $casts = ['bookmarked' => 'boolean', 'applied' => 'boolean', 'can_apply' => 'boolean'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value) . '-' . time() . '-' . uniqid();
    }

    public function getFullAddressAttribute()
    {
        $country = $this->country;
        $region = $this->region;
        $extra = $region != null ? ' , ' : '';
        return $region . $extra . $country;
    }

    public function getDaysRemainingAttribute()
    {
        return Carbon::now(config('zakirsoft.timezone'))->parse($this->deadline)->diffForHumans(null, true, true, 2);
    }

    public function getCanApplyAttribute()
    {
        if ($this->apply_on === 'app') {
            return true;
        } else {
            return false;
        }
    }

    public function getDeadlineActiveAttribute()
    {
        return Carbon::parse($this->deadline)->format('Y-m-d') >= Carbon::now()->toDateString();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeOpenPosition($query)
    {
        return $query->where('status', 'active')->where('deadline', '>=', Carbon::now()->toDateString());
    }

    public function scopeCompanyJobs($query, $company_id)
    {
        return $query->where('company_id', $company_id);
    }

    public function scopeNewJobs($query)
    {
        return $query->where('status', 'active')->where('created_at', '>=', Carbon::now()->subDays(7)->toDateString());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(JobRole::class, 'role_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->with('user');
    }

    public function bookmarkJobs()
    {
        return $this->belongsToMany(Candidate::class, 'bookmark_candidate_job');
    }

    public function appliedJobs()
    {
        return $this->belongsToMany(Candidate::class, 'applied_jobs')->withPivot('job_id', 'candidate_id')->with('user')->withTimestamps();
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class, 'experience_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public function job_type()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function salary_type()
    {
        return $this->belongsTo(SalaryType::class, 'salary_type_id');
    }
}
