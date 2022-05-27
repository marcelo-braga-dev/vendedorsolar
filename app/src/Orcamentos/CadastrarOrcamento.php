<?php

namespace App\src\Orcamentos;

use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\TaxaComissoes;
use App\Models\Trafos;
use App\src\Orcamentos\Status\Novo;

class CadastrarOrcamento
{
    private $users_id;
    private $kits_id;
    private $cidade;
    private $geracao;
    private $estrutura;
    private $tensao;
    private $orientacao;
    private $consumo;
    private $clientes_id;
    private $taxa_comissao;
    private $preco_cliente;
    private $status;
    private $token;
    private $trafo;
    private $qtdKits;
    private $precoTrafo;
    private $consumoPonta;
    private $consumoForaPonta;

    public function __construct(DadosOrcamento $dados)
    {
        $this->users_id = id_usuario_atual();
        $this->kits_id = $dados->id_kit;
        $this->cidade = $dados->cidade;
        $this->geracao = $dados->geracao;
        $this->estrutura = $dados->estrutura;
        $this->tensao = $dados->tensao;
        $this->orientacao = $dados->orientacao;
        $this->consumo = $dados->consumo;
        $this->clientes_id = $dados->cliente;
        $this->trafo = $dados->trafo;
        $this->qtdKits = $dados->qtdKits;
        $this->precoTrafo = $this->setPrecoTrafo($dados->trafo);
        $this->taxa_comissao = $this->setTaxaComissao();
        $this->preco_cliente = $dados->preco;//setPrecoKit($dados->id_kit);
        $this->status = (new Novo())->getStatus();
        $this->token = uniqid();
        $this->consumoPonta = $dados->consumoPonta;
        $this->consumoForaPonta = $dados->consumoForaPonta;
    }

    private function setTaxaComissao()
    {
        try {
            $comissao = new TaxaComissoes();

            $dados = $comissao->newQuery()
                ->where('user_id', '=', $this->users_id)
                ->first('taxa');

            return $dados->taxa;
        } catch (\ErrorException $e) {
            modalErro('Não foi encontrado a sua porcentagem de comissão por venda.
            Por favor, entre em contato com um administrador.');
            throw new \DomainException();
        }
    }

    public function cadastrar()
    {
        return (new Orcamentos())->cadastrar($this);
    }

    public function getTaxaComissao()
    {
        return $this->taxa_comissao;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getCliente()
    {
        return $this->clientes_id;
    }

    public function getConsumo()
    {
        return $this->consumo;
    }

    public function getEstrutura()
    {
        return $this->estrutura;
    }

    public function getGeracao()
    {
        return $this->geracao;
    }

    public function getKitId()
    {
        return $this->kits_id;
    }

    public function getOrientacao()
    {
        return $this->orientacao;
    }

    public function getPrecoCliente(): float
    {
        return $this->preco_cliente;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTensao()
    {
        return $this->tensao;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUsersId()
    {
        return $this->users_id;
    }

    public function getTrafo()
    {
        return $this->trafo;
    }

    public function getQtdKits()
    {
        return $this->qtdKits;
    }

    public function setPrecoTrafo($idTrafo)
    {
        $trafos = new Trafos();
        $trafo = $trafos->newQuery()
            ->find($idTrafo);

        return $trafo->preco_cliente ?? 0;
    }

    public function getConsumoPonta()
    {
        return $this->consumoPonta;
    }

    public function getConsumoForaPonta()
    {
        return $this->consumoForaPonta;
    }
}
