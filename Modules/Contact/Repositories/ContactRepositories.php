<?php

namespace Modules\Contact\Repositories;

use Modules\Contact\Actions\MultipleDeleteContact;

class ContactRepositories implements ContactInterface
{
    public function multipleDestroy(Object $data)
    {
        return MultipleDeleteContact::delete($data);;
    }
}
