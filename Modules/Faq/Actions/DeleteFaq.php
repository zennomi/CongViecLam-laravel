<?php

namespace Modules\Faq\Actions;

class DeleteFaq
{
    public static function delete($faq)
    {
        return $faq->delete();
    }
}
