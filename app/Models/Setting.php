<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'search_engine_indexing'  =>  'boolean',
        'google_analytics'  =>  'boolean',
    ];

    protected $appends = ['dark_logo_url', 'light_logo_url', 'favicon_image_url'];

    public function getDarkLogoUrlAttribute()
    {
        if (is_null($this->dark_logo)) {
            return asset('frontend/assets/images/logo/logo.png');
        }

        return asset($this->dark_logo);
    }

    public function getLightLogoUrlAttribute()
    {
        if (is_null($this->light_logo)) {
            return asset('frontend/assets/images/logo/logowhite.png');
        }

        return asset($this->light_logo);
    }

    public function getFaviconImageUrlAttribute()
    {
        if (is_null($this->favicon_image)) {
            return asset('frontend/assets/images/logo/fav.png');
        }

        return asset($this->favicon_image);
    }
}
