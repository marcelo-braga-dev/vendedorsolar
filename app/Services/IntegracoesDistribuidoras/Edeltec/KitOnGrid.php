<?php

namespace App\Services\IntegracoesDistribuidoras\Edeltec;

use App\src\Produtos\CalculoPrecos\CalcularPrecoVenda;
use App\src\Produtos\CalculoPrecos\MargensPadrao;
use App\src\Produtos\Kit;

class KitOnGrid extends Kit
{
    private $indices;

    public function __construct($produto, $indices)
    {
        $this->indices = $indices;

        $this->sku($produto['codProd']);
        $this->modelo($produto['titulo']);
        $this->potenciaKit($produto['potenciaGerador']);
        $this->marcaInversor($produto['fabricante']);
        $this->marcaPainel($produto['marca']);
        $this->potenciaInversor($produto['potenciaInversor']);
        $this->potenciaPainel($produto['potenciaModulo']);
        $this->precoFornecedor($produto['precoDoIntegrador']);
        $this->fornecedor('');
        $this->tensao($produto['tensaoSaida']);
        $this->estrutura($produto['estrutura']);
        $this->produtos($produto['componentes']);
        $this->observacoes('');
        $this->margem($produto['potenciaGerador']);
    }

    public function sku(string $dado)
    {
        $this->setSku($dado);
    }

    public function modelo(string $dado)
    {
        $this->setModelo(str_replace(' edeltec', '', $dado));
    }

    public function potenciaKit(string $dado)
    {
        $this->setPotenciaKit($dado);
    }

    public function marcaInversor(string $dado)
    {
        if (!isset($this->indices[$dado])) {
            throw new \DomainException("Marca do INVERSOR não encontrada: {$dado}");
        }
        $this->setMarcaInversor($this->indices[$dado]);
    }

    public function marcaPainel(string $dado)
    {
        if (!isset($this->indices[$dado])) {
            throw new \DomainException("Marca do PAINEL não encontrada: {$dado}");
        }
        $this->setMarcaPainel($this->indices[$dado]);
    }

    public function potenciaInversor(string $dado)
    {
        $this->setPotenciaInversor($dado);
    }

    public function potenciaPainel(string $dado)
    {
        $this->setPotenciaPainel($dado);
    }

    public function precoFornecedor(string $dado)
    {
        $this->setPrecoFornecedor($dado);
    }

    public function fornecedor(string $dado)
    {
        if (!isset($this->indices['EDELTEC'])) {
            throw new \DomainException("Fornecedor 'EDELTEC' não configurado nos índices de integração.");
        }
        $this->setFornecedor($this->indices['EDELTEC']);
    }

    public function tensao(string $dado)
    {
        $this->setTensao(intval($dado));
    }

    public function estrutura(string $dado)
    {
        if (!isset($this->indices[$dado])) {
            throw new \DomainException("Estrutura não encontrada: {$dado}");
        }
        $this->setEstrutura($this->indices[$dado]);
    }

    public function produtos(string $dado)
    {
        $this->setProdutos($dado);
    }

    public function observacoes(string $dado)
    {
        $this->setObservacoes(null);
    }

    public function margem(string $potenciaKit)
    {
        $this->setMargem((new CalcularPrecoVenda())->calcular(new MargensPadrao($potenciaKit)));
    }
}
