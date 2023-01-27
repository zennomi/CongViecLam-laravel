<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'role_id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'role_id');
    }
}
