<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarDropdown extends Component
{
    public $linkActive, $subLinkActive, $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($linkActive, $subLinkActive, $icon)
    {
        $this->linkActive = $linkActive;
        $this->subLinkActive = $subLinkActive;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.sidebar-dropdown');
    }
}
