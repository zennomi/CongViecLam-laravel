<?php

namespace Modules\Blog\Entities;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostCategory extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-post.png');
        }

        return asset($this->image);
    }

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostCategoryFactory::new();
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
