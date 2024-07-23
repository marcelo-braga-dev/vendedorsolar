<?php

namespace App\View\Components\Status;

use Illuminate\View\Component;

class IconBool extends Component
{
    public $status;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status = null)
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.status.icon-bool');
    }
}
