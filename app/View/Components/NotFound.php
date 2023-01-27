<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotFound extends Component
{
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message = 'Nothing Found')
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.not-found');
    }
}
