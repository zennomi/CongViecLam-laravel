<?php

namespace Modules\SetupGuide\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetupGuide extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\SetupGuide\Database\factories\SetupGuideFactory::new();
    }
}
