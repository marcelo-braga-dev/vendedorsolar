<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Input extends Component
{
    public $value;
    public $label;
    public $type;
    public $name;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $type, string $name, ?string $value = null, ?string $class = null)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.input');
    }
}
