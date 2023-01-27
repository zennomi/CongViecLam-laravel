<?php

namespace Modules\Location\Entities;

use App\Models\Job;
use Modules\Location\Entities\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Location\Database\factories\CountryFactory::new();
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function city()
    {
        return $this->hasMany(city::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'country_id', 'id');
    }
}
