<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo_image',
        'favicon_image',
    ];
}
