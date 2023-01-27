<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class DeletIcon extends Component
{
    public $height, $width, $stroke, $fill;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($height = 48, $width = 48, $stroke = '#FF4F4F', $fill = 'none')
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
        return view('components.svg.delet-icon');
    }
}
