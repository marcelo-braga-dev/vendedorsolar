<?php

namespace App\View\Components;

use App\src\Usuarios\TiposUsuarios;
use Illuminate\View\Component;

class Layout extends Component
{
    public $tipoUsuario;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tipoUsuario = (new TiposUsuarios())->getTipoUsuarioAtual();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.layout');
    }
}
