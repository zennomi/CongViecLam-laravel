<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Label extends Component
{
    public $name, $required, $for, $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $required = true, $for = null, $class = null)
    {
        $this->name = $name;
        $this->required = $required;
        $this->for = $for;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.label');
    }
}
