<?php

namespace App\View\Components\Website\Candidate;

use Illuminate\View\Component;

class RecentsActivities extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $recentActivities;

    public function __construct($recentActivities)
    {
        $this->recentActivities = $recentActivities;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.website.candidate.recents-activities');
    }
}
