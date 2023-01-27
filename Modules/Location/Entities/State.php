<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Str;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name',
        'slug'
    ];

    protected static function newFactory()
    {
        return \Modules\Location\Database\factories\StateFactory::new();
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
