<?php

namespace App\View\Components\Layout\Body;

use Illuminate\View\Component;

class Main extends Component
{
    public $title;
    public $urlButton;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $urlButton)
    {
        $this->title = $title;
        $this->urlButton = $urlButton;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $urlButton = $this->urlButton;

        if ($urlButton == 'back') $this->urlButton = url()->previous();

        return view('components.layout.body.main');
    }
}
