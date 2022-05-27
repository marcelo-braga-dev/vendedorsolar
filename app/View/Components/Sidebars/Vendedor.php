<?php

namespace App\View\Components\Sidebars;

use App\Models\Configs;
use Illuminate\View\Component;

class Vendedor extends Component
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
        $config = new Configs();
        $logo = $config->getInfo('logo');

        return view('components.sidebars.vendedor', compact('logo'));
    }
}
