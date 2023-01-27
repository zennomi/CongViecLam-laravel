<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'icon'
    ];
    protected $appends = ['image_url', 'open_jobs_count'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default.png');
        }

        return asset($this->image);
    }

    public function getOpenJobsCountAttribute()
    {
        return $this->jobs()
            ->where('status', 'active')
            ->where('deadline', '>=', Carbon::now()->toDateString())
            ->count();
        // return Job::where('category_id', $this->id)->where('status', 'active')->where('deadline', '>=', Carbon::now()->toDateString())->count();
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_id');
    }
}
