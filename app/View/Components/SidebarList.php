<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarList extends Component
{
    public $linkActive, $route, $parameter, $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($linkActive, $route, $parameter = null, $icon)
    {
        $this->linkActive = $linkActive;
        $this->route = $route;
        $this->parameter = $parameter;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.sidebar-list');
    }
}
