<?php

namespace App\Models;

use App\Models\AppliedJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function applications(){
        return $this->hasMany(AppliedJob::class,'application_group_id');
    }

}
