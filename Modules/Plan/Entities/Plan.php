<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Plan\Database\factories\PriceplanFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        "label",
        "description",
        "price",
        "job_limit",
        "featured_job_limit",
        "highlight_job_limit",
        "recommended",
        "frontend_show",
        'candidate_cv_view_limit'
    ];

    protected $casts = [
        'frontend_show' => 'boolean',
        'recommended' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('frontend_show', true);
    }

    protected static function newFactory()
    {
        return PriceplanFactory::new();
    }
}
