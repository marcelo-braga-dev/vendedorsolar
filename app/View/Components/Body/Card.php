<?php

namespace App\View\Components\Body;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $urlButton;
    public $class;
    public $textButton;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $title = null,
                                ?string $urlButton = null,
                                ?string $textButton = null,
                                ?string $class = null)
    {
        $this->title = $title;
        $this->urlButton = $urlButton;
        $this->class = $class;
        $this->textButton = $textButton;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->urlButton == 'back') $this->urlButton = url()->previous();

        return view('components.body.card');
    }
}
