<?php

namespace App\View\Components\Inputs\Select;

use Illuminate\View\Component;

class OptionSelected extends Component
{
    public $items;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($items, $selected)
    {
        $this->items = $items;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.select.option-selected');
    }
}
