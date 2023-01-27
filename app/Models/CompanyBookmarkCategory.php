<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBookmarkCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'name'
    ];

    public function bookmarks(){

        return $this->belongsToMany('bookmark_company_category');
    }
}
