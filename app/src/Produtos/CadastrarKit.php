<?php

namespace App\src\Produtos;

use App\Http\Requests\FormCadastroKitRequest;
use App\src\Produtos\CalculoPrecos\CalcularPrecoVenda;
use App\src\Produtos\CalculoPrecos\MargensPadrao;

class CadastrarKit extends Kit
{
    public function __construct(FormCadastroKitRequest $kit)
    {
        $this->sku($kit->sku);
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
        $this->margem($kit->potencia_kit);
        $this->statusFornecedor($kit->status_fornecedor);
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

    protected function margem(string $potenciaKit)
    {
        $margem = (new CalcularPrecoVenda())->calcular(new MargensPadrao($potenciaKit));
        $this->setMargem($margem);
    }

    protected function sku($dado)
    {
        $this->setSku($dado);
    }

    protected function statusFornecedor(?int $status)
    {
        $this->setStatusFornecedor($status);
    }
}
