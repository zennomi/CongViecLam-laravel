<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Faq\Database\factories\FaqFactory::new();
    }


    public function faq_category()
    {
        return $this->belongsTo(FaqCategory::class);
    }
}
