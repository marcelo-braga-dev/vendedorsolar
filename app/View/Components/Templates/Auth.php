<?php

namespace App\View\Components\Templates;

use App\Models\User;
use App\Models\UserMeta;
use App\src\Usuarios\AdminVendedor;
use App\src\Usuarios\Vendedores;
use Illuminate\View\Component;

class Auth extends Component
{
    private $tipoUsuario;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function render()
    {
        switch ($this->tipoUsuario) {
            case (new Vendedores())->getChave() :
                return view('components.templates.vendedor');
            case (new \App\src\Usuarios\Admin())->getChave() :
                return view('components.templates.admin');
            case (new AdminVendedor())->getChave() :
                return $this->adminVendedor();
            default :
                throw new \DomainException('Tipo de usuário não identificado.');
        }
    }

    private function adminVendedor()
    {
        $acesso = (new UserMeta())->metas(id_usuario_atual());

        switch ($acesso['tipo_atual'] ?? null) {
            case (new Vendedores())->getChave() :
                return view('components.templates.vendedor');
            default :
                return view('components.templates.admin');
        }
    }
}
