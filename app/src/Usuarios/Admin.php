<?php

namespace App\src\Usuarios;

class Admin
{
    private string $chave = 'admin';
    private string $nome = 'Admin';

    public function getChave(): string
    {
        return $this->chave;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function auth():bool
    {
        $tipoAtual = (new TiposUsuarios())->getTipoUsuarioAtual();
        $adminVendedor = (new AdminVendedor())->getChave();

        if ($tipoAtual == $this->chave || $tipoAtual == $adminVendedor){
            return false;
        }
        return true;
    }
}
