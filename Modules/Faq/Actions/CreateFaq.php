<?php

namespace Modules\Faq\Actions;

use Modules\Faq\Entities\Faq;

class CreateFaq
{
    public static function create($request)
    {
        return Faq::create($request->all());
    }
}
