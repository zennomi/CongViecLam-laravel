<?php

namespace Modules\Location\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Ad\Entities\Ad;
use Modules\Location\Entities\Country;


class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['image_url'];

    protected static function newFactory()
    {
        return \Modules\Location\Database\factories\CityFactory::new();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-thumbnail.jpg');
        }

        return asset($this->image);
    }

    /**
     *  Has many relation with Ad
     *
     */
    public function ads()
    {
        return $this->hasMany(Ad::class, 'city_id');
    }

    public function towns()
    {
        return $this->hasMany(Town::class, 'city_id');
    }


    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
