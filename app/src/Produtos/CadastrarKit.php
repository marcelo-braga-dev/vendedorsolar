<?php

namespace App\src\Produtos;

use App\Http\Requests\FormCadastroKitRequest;
use App\src\Produtos\CalculoPrecos\CalcularPrecoVenda;
use App\src\Produtos\CalculoPrecos\MargensPadrao;

class CadastrarKit extends Kit
{
    public function __construct(FormCadastroKitRequest $kit)
    {
        // $this->sku($kit->codigo);
        $this->modelo($kit->modelo);
        $this->potenciaKit($kit->potencia_kit);
        $this->marcaInversor($kit->marca_inversor);
        $this->marcaPainel($kit->marca_painel);
        $this->potenciaInversor($kit->potencia_inversor);
        $this->potenciaPainel($kit->potencia_painel);
        $this->precoFornecedor($kit->preco_fornecedor);
        $this->fornecedor($kit->fornecedor);
        $this->estrutura($kit->estrutura);
        $this->tensao($kit->tensao);
        $this->produtos($kit->produtos);
        $this->observacoes($kit->observacoes);
        $this->precoCliente($kit->preco_fornecedor, $kit->potencia_kit);
    }

    protected function modelo(string $dado)
    {
        $this->setModelo($dado);
    }

    protected function potenciaKit(string $dado)
    {
        $this->setPotenciaKit($dado);
    }

    protected function marcaInversor(string $dado)
    {
        $this->setMarcaInversor($dado);
    }

    protected function marcaPainel(string $dado)
    {
        $this->setMarcaPainel($dado);
    }

    protected function potenciaInversor(string $dado)
    {
        $this->setPotenciaInversor($dado);
    }

    protected function potenciaPainel(string $dado)
    {
        $this->setPotenciaPainel($dado);
    }

    protected function precoFornecedor(string $dado)
    {
        $this->setPrecoFornecedor(convert_money_float($dado));
    }

    protected function fornecedor(string $dado)
    {
        $this->setFornecedor($dado);
    }

    protected function estrutura(string $dado)
    {
        $this->setEstrutura($dado);
    }

    protected function tensao(string $dado)
    {
        $this->setTensao($dado);
    }

    protected function produtos(string $dado)
    {
        $this->setProdutos($dado);
    }

    protected function observacoes(?string $dado)
    {
        $this->setObservacoes($dado);
    }

    protected function precoCliente(string $valor, string $potenciaKit)
    {
        $calcular = new CalcularPrecoVenda();
        $preco = $calcular->calcular(new MargensPadrao(convert_money_float($valor), $potenciaKit));

        $this->setPrecoCliente($preco['preco']);
        $this->margem($preco['margem']);
    }

    protected function margem(string $dados)
    {
        $this->setMargem($dados);
    }

    protected function sku(string $dado)
    {
        // TODO: Implement sku() method.
    }
}
