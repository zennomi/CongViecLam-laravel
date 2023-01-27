<?php

namespace Modules\Faq\Actions;

use Carbon\Carbon;

class UpdateFaq
{
    public static function update($request, $faq)
    {
        $faq->update($request->all());
        return $faq;
    }
}
