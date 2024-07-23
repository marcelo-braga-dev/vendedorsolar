<?php

namespace App\Services\IntegracoesDistribuidoras\Edeltec;

use App\src\Integracoes\Aldo\Produtos\Infos\ProdutosKit;
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
