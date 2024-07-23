<?php

namespace App\src\Integracoes\Aldo\Produtos;

use App\src\Integracoes\Aldo\Produtos\Infos\ProdutosKit;
use App\src\Produtos\CalculoPrecos\CalcularPrecoVenda;
use App\src\Produtos\CalculoPrecos\MargensPadrao;
use App\src\Produtos\Kit;

class KitOnGrid extends Kit
{
    private $indices;

    public function __construct(\SimpleXMLElement $produto, $indices)
    {
        $this->indices = $indices;

        $this->sku($produto->codigo);
        $this->modelo($produto->descricao);
        $this->potenciaKit($produto->atributos->POTENCIA_W);
        $this->marcaInversor($produto->atributos->MARCA_INVERSOR);
        $this->marcaPainel($produto->atributos->MARCA_PAINEL);
        $this->potenciaInversor($produto->descricao);
        $this->potenciaPainel($produto->atributos->MARCA_PAINEL);
        $this->precoFornecedor($produto->preco);
        $this->fornecedor('');
        $this->tensao($produto->atributos->TENSAO_SAIDA);
        $this->estrutura($produto->atributos->TIPO_ESTRUTURA);
        $this->produtos($produto->descricao_tecnica);
        $this->observacoes('');
        $this->margem($produto->atributos->POTENCIA_W);
    }

    public function sku(string $dado)
    {
        $this->setSku($dado);
    }

    public function modelo(string $dado)
    {
        $this->setModelo($dado);
    }

    public function potenciaKit(string $dado)
    {
        $this->setPotenciaKit($dado);
    }

    public function marcaInversor(string $dado)
    {
        $id = $this->indices['inversor'][$dado]['id_referencia'];
        $this->setMarcaInversor($id);
    }

    public function marcaPainel(string $dado)
    {
        try {
            $id = $this->indices['painel'][$dado]['id_referencia'];
            $this->setMarcaPainel($id);
        } catch (\ErrorException $e) {
            throw new \DomainException($dado);
        }
    }

    public function potenciaInversor(string $dado)
    {
        preg_match('/.{5}KW /', $dado, $var);
        $potenciaInversor = str_replace('KW ', '', $var[0]);
        $potenciaInversor = preg_replace('/(.+)\s/', '', $potenciaInversor);
        $this->setPotenciaInversor($potenciaInversor);
    }

    public function potenciaPainel(string $dado)
    {
        try {
        $potencia = $this->indices['painel'][$dado]['potencia'];

        $this->setPotenciaPainel($potencia);
        } catch (\ErrorException $e) {
            throw new \DomainException();
        }
    }

    public function precoFornecedor(string $dado)
    {
        $this->setPrecoFornecedor(convert_money_float($dado));
    }

    public function fornecedor(string $dado)
    {
        $this->setFornecedor(1);
    }

    public function tensao(string $dado)
    {
        $this->setTensao(intval($dado));
    }

    public function estrutura(string $dado)
    {
        $this->setEstrutura($this->indices['estrutura'][$dado]['id_referencia']);
    }

    public function produtos(string $dado)
    {
        $this->setProdutos((new ProdutosKit())->get($dado));
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
