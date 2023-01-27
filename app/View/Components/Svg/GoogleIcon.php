<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class GoogleIcon extends Component
{
    public $height, $width;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($height = 20, $width = 20)
    {
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.google-icon');
    }
}
