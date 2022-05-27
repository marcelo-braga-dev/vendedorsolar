<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $label;
    public $value;
    public $name;

    public function __construct($label, $name, $value = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }
    public function render()
    {
        return view('components.inputs.textarea');
    }
}
