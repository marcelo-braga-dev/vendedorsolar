<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Body extends Component
{
    public $title;
    public $urlButton;
    public $class;
    public $textButton;

    public function __construct(
        string  $title,
        ?string $urlButton = null,
        ?string $textButton = null,
        ?string $class = null)
    {
        $this->title = $title;
        $this->urlButton = $urlButton;
        $this->class = $class;
        $this->textButton = $textButton;
    }

    public function render()
    {
        if ($this->urlButton == 'back') $this->urlButton = url()->previous();

        return view('components.body');
    }
}
