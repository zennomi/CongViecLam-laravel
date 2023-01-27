<?php

namespace App\Models;

use Modules\Location\Entities\City;
use Modules\Location\Entities\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Location\Entities\State;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'secondary_phone',
        'email',
        'secondary_email'
    ];
}
