<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function job(){

        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function candidate(){

        return $this->belongsTo(Candidate::class, 'candidate_id', 'id')->withCount(['bookmarkCandidates as bookmarked' => function ($q) {
            $q->where('company_id', auth('user')->user()->company->id);
        }])
        ->withCasts(['bookmarked' => 'boolean']);
    }

    public function shortlists(){

        return $this->belongsToMany(AppliedJob::class, 'company_applied_job_shortlist', 'applied_job_id', 'company_id')->withTimestamps();
    }

    public function rejects(){

        return $this->belongsToMany(AppliedJob::class, 'company_applied_job_rejected', 'applied_job_id', 'company_id')->withTimestamps();
    }

    public function resume(){
        return $this->belongsTo(CandidateResume::class, 'candidate_resume_id');
    }

    public function applicationGroup(){
        return $this->belongsTo(ApplicationGroup::class, 'application_group_id');
    }
}
