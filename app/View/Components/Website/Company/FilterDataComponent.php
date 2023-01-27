<?php

namespace App\View\Components\Website\Company;

use Illuminate\View\Component;

class FilterDataComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $filter;
    public $title;
    public $onClick;

    public function __construct($filter, $title, $onClick)
    {
        $this->filter = $filter;
        $this->title = $title;
        $this->onClick = $onClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.website.company.filter-data-component');
    }
}
