<?php

namespace App\src\Usuarios;

use App\Models\User;

class TiposUsuarios
{
    public function todos()
    {
        $vendedor = (new Vendedores());
        $admin = (new Admin());
        $adminVendedor = (new AdminVendedor());

        return [
            $vendedor->getChave() => $vendedor->getNome(),
            $admin->getChave() => $admin->getNome(),
            $adminVendedor->getChave() => $adminVendedor->getNome(),
        ];
    }

    public function getTipoUsuarioAtual()
    {
        return (new User())->getTipoUsuario(id_usuario_atual());
    }

    public function isAdminVendedor():bool
    {
        $adminVendedor = (new AdminVendedor())->getChave();
        if ($this->getTipoUsuarioAtual() == $adminVendedor) return true;
        return false;
    }
}
