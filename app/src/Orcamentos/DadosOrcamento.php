<?php

namespace App\src\Orcamentos;

class DadosOrcamento
{
    public $consumo;
    public $consumoPonta;
    public $consumoForaPonta;
    public $id_kit;
    public $cidade;
    public $geracao;
    public $estrutura;
    public $tensao;
    public $orientacao;
    public $cliente;
    public $trafo;
    public $qtdKits;
    public $preco;
    public $demandaContratada;

    public function __construct($dados)
    {
        $this->consumo = $dados->consumo;
        $this->consumoPonta = $dados->consumo_ponta;
        $this->consumoForaPonta = $dados->consumo_fora_ponta;
        $this->id_kit = $dados->id_kit;
        $this->cidade = $dados->cidade;
        $this->geracao = $dados->geracao;
        $this->estrutura = $dados->estrutura;
        $this->tensao = $dados->tensao;
        $this->orientacao = $dados->orientacao;
        $this->cliente = $dados->cliente;
        $this->trafo = $dados->trafo;
        $this->qtdKits = $dados->qtd_kits;
        $this->preco = $dados->preco;
        $this->demandaContratada = $dados->demanda;
    }
}
