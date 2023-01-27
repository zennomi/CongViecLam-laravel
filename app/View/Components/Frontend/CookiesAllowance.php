<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class CookiesAllowance extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $cookies;
    
    public function __construct($cookies)
    {
        $this->cookies = $cookies;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.cookies-allowance');
    }
}
