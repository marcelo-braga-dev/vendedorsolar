<?php

namespace App\src\Usuarios;

use App\Models\TaxaComissoes;
use App\Models\UserMeta;

class AdminVendedor implements DadosUsuario
{
    private string $chave = 'admin_vendedor';
    private string $nome = 'Admin/Vendedor';
    public $cpf;
    public $cnpj;
    public $rg;
    public $celular;
    public $taxa_comissao;

    public function __construct()
    {
        $this->cpf = null;
        $this->cnpj = null;
        $this->rg = null;
        $this->celular = null;
        $this->taxa_comissao = null;
    }

    public function metas($id)
    {
        $user = new UserMeta();

        $user->salvar($id, 'cpf', $this->cpf);
        $user->salvar($id, 'cnpj', $this->cnpj);
        $user->salvar($id, 'rg', $this->rg);
        $user->salvar($id, 'celular', $this->celular);
    }

    public function comissao($id)
    {
        $comissao = new TaxaComissoes();

        $comissao->newQuery()
            ->updateOrInsert(
                ['user_id' => $id], ['taxa' => $this->taxa_comissao]
            );
    }

    public function getChave(): string
    {
        return $this->chave;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}
