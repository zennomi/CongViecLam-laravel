<?php

namespace Modules\Seo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    protected static function newFactory()
    {
        return \Modules\Seo\Database\factories\SeoFactory::new();
    }

    // muttor

    public function setPageSlugAttribute($value){

        $this->attributes['page_slug'] = Str::slug($value);
    }
}
