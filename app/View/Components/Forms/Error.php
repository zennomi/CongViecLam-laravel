<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Error extends Component
{
    public $name,$class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$class = null)
    {
        $this->name = $name;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.error');
    }
}
