<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckIcon extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $width;
     public $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.check-icon');
    }
}
