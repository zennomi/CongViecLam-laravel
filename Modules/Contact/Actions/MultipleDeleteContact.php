<?php

namespace Modules\Contact\Actions;

use Modules\Contact\Entities\Contact;

class MultipleDeleteContact
{
    public static function delete($request)
    {
        return Contact::whereIn('id', $request->id)->delete();
    }
}
