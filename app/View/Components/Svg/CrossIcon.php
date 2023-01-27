<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class CrossIcon extends Component
{
    public $height, $width, $stroke, $fill;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($height = 50, $width = 50, $stroke = 'currentColor', $fill = 'none')
    {
        $this->height = $height;
        $this->width = $width;
        $this->stroke = $stroke;
        $this->fill = $fill;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.cross-icon');
    }
}
