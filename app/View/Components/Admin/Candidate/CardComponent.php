<?php

namespace App\View\Components\Admin\Candidate;

use Illuminate\View\Component;

class CardComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $jobs;
    public $link;

    public function __construct($title, $jobs, $link)
    {
        $this->title = $title;
        $this->jobs = $jobs;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.candidate.card-component');
    }
}
