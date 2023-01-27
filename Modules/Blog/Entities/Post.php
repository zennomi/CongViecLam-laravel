<?php

namespace Modules\Blog\Entities;

use App\Models\Admin;
use Illuminate\Support\Str;
use Modules\Blog\Entities\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Entities\PostComment;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id', 'author_id', 'title', 'slug', 'image', 'short_description', 'description', 'status'
    ];

    protected $appends = ['image_url'];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-post.png');
        }

        return asset($this->image);
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class)->whereNull('parent_id')->latest();
    }

    public function commentsCount(){
        return $this->hasMany(PostComment::class)->count();
    }
}
