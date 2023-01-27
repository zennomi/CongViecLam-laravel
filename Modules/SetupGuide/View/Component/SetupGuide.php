<?php

namespace Modules\SetupGuide\View\Component;

use Illuminate\View\Component;
use Modules\SetupGuide\Entities\SetupGuide as SetupGuideEntity;

class SetupGuide extends Component
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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data = SetupGuideEntity::orderBy('status', 'asc')->get();
        $incomplete = $data->where('status', 0)->count();

        if ($incomplete) {
            return view('setupguide::components.setupguidecomponent', compact('data'));
        }
    }
}
