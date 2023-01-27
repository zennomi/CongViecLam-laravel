<?php

namespace App\View\Components\Website\Job;

use Illuminate\View\Component;

class JobListStyleSwitcher extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.website.job.job-list-style-switcher');
    }
}
