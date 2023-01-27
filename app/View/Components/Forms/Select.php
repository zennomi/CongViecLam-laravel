<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $name, $id, $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id = null, $class = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
