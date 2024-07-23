<?php

namespace App\src\Produtos;

use App\Models\Kits;
use App\src\Produtos\CalculoPrecos\CalcularPrecoVenda;
use App\src\Produtos\CalculoPrecos\MargensPadrao;

abstract class Kit extends InfoKit
{
    private $sku;
    private $modelo;
    private $marca_inversor;
    private $potencia_inversor;
    private $potencia_painel;
    private $marca_painel;
    private $potencia_kit;
    private $preco_fornecedor;
    private $preco_cliente;
    private $estrutura;
    private $produtos;
    private $observacoes;
    private $fornecedor;
    private $tensao;
    private $margem;
    private $statusFornecedor;

    public function cadastrar()
    {
        (new Kits())->cadastrarKit($this);
    }

    public function atualizar(int $id)
    {
        (new Kits())->atualizarKit($id, $this);
    }

    public function atualizarPreco($dados, $skus): void
    {
        $precoAtual = number_format($skus[strip_tags($dados->codigo)], 2, '.', '');;
        $precoFornecedor = convert_money_float(strip_tags($dados->preco));

        if ($precoAtual != $precoFornecedor) {
            (new Kits())->atualizarPrecosPeloSKU(strip_tags($dados->codigo), $precoFornecedor);
        }
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    protected function setModelo($modelo): void
    {
        $this->modelo = $modelo;
    }

    public function getMarcaInversor()
    {
        return $this->marca_inversor;
    }

    protected function setMarcaInversor($marca_inversor): void
    {
        $this->marca_inversor = $marca_inversor;
    }

    public function getPotenciaInversor()
    {
        return $this->potencia_inversor;
    }

    protected function setPotenciaInversor($potencia_inversor): void
    {
        $this->potencia_inversor = $potencia_inversor;
    }

    public function getPotenciaPainel()
    {
        return $this->potencia_painel;
    }

    protected function setPotenciaPainel($potencia_painel): void
    {
        $this->potencia_painel = $potencia_painel;
    }

    public function getMarcaPainel()
    {
        return $this->marca_painel;
    }

    protected function setMarcaPainel($marca_painel): void
    {
        $this->marca_painel = $marca_painel;
    }

    public function getPotenciaKit()
    {
        return $this->potencia_kit;
    }

    protected function setPotenciaKit($potencia_kit): void
    {
        $this->potencia_kit = $potencia_kit;
    }

    public function getPrecoFornecedor()
    {
        return $this->preco_fornecedor;
    }

    protected function setPrecoFornecedor($preco_fornecedor): void
    {
        $this->preco_fornecedor = $preco_fornecedor;
    }

    public function getEstrutura()
    {
        return $this->estrutura;
    }

    protected function setEstrutura($estrutura): void
    {
        $this->estrutura = $estrutura;
    }

    public function getProdutos()
    {
        return $this->produtos;
    }

    protected function setProdutos($produtos): void
    {
        $this->produtos = $produtos;
    }

    public function getObservacoes()
    {
        return $this->observacoes;
    }

    protected function setObservacoes($observacoes): void
    {
        $this->observacoes = $observacoes;
    }

    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    protected function setFornecedor($fornecedor): void
    {
        $this->fornecedor = $fornecedor;
    }

    public function getTensao()
    {
        return $this->tensao;
    }

    protected function setTensao($tensao): void
    {
        $this->tensao = $tensao;
    }

    public function getSku()
    {
        return $this->sku;
    }

    protected function setSku($sku): void
    {
        $this->sku = $sku;
    }

    public function getPrecoCliente()
    {
        return $this->preco_cliente;
    }

    protected function setPrecoCliente($precoCliente): void
    {
        $this->preco_cliente = $precoCliente;
    }

    public function getMargem()
    {
        return $this->margem;
    }

    protected function setMargem($margem): void
    {
        $this->margem = $margem;
    }

    protected function setStatusFornecedor($status)
    {
        $this->statusFornecedor = $status;
    }

    public function getStatusFornecedor()
    {
        return $this->statusFornecedor;
    }
}
