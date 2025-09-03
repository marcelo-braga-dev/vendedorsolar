<?php

namespace App\View\Components\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Container extends Component
{
    public $title;
    public $urlButton;
    public $class;
    public $textButton;

    /**
     * Create a new component instance.
     */
    public function __construct(
        ?string  $title,
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
     */
    public function render(): View|Closure|string
    {
        if ($this->urlButton == 'back') $this->urlButton = url()->previous();

        return view('components.layout.container');
    }
}
