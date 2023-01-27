<?php

namespace App\View\Components\Website\Company;

use Illuminate\View\Component;

class ErrorMessage extends Component
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public function render()
    {
        return view('components.website.company.error-message');
    }
}
