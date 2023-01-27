<?php

namespace App\Traits;

use App\Models\Social;
use Illuminate\Database\Eloquent\Relations\MorphOne;


trait Socialable {

    /**
     * Boot the trait
     *
     * @return void
     */
    protected static function bootSocialable(){

        static::created(function($model){
            $model->social()->create();
        });

        static::deleting(function($model){
            $model->social->delete();
        });
    }


    public function social(): MorphOne
    {
        return $this->morphOne(Social::class, 'socialable');
    }
}
