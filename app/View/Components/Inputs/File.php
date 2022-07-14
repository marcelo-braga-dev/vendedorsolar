<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class File extends Component
{
    public string $label;
    public string $name;
    public $url;
    public $download;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $name, $url = null, $download = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->url = $url;
        $this->download = $download;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.file');
    }
}
