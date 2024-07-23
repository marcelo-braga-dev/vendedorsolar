<?php

namespace App\View\Components\Graficos;

use Illuminate\View\Component;

class PaybackFotovoltaico extends Component
{
    private float $precoCliente;

    public function __construct(float $precoCliente)
    {
        $this->precoCliente = $precoCliente;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $precoCliente = $this->precoCliente;

        return view('components.graficos.payback-fotovoltaico', compact('precoCliente'));
    }
}
