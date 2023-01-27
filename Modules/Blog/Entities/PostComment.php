<?php

namespace Modules\Blog\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'post_id', 'body'
    ];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostCommentFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id','id');
    }
    
    public function replies(){
        return $this->hasMany(PostComment::class, 'parent_id')->latest();
    }
}
