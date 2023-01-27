<?php

namespace Modules\Faq\Entities;

use Modules\Faq\Entities\Faq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
