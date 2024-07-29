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
        $res = str_replace(' edeltec', '', $dado);
        $this->setModelo($res);
    }

    public function potenciaKit(string $dado)
    {
        $this->setPotenciaKit($dado);
    }

    public function marcaInversor(string $dado)
    {
        $id = $this->indices[$dado];
        $this->setMarcaInversor($id);
    }

    public function marcaPainel(string $dado)
    {
        try {
            $id = $this->indices[$dado];
            $this->setMarcaPainel($id);
        } catch (\ErrorException $e) {
            throw new \DomainException($dado);
        }
    }

    public function potenciaInversor(string $dado)
    {
        $this->setPotenciaInversor($dado);
    }

    public function potenciaPainel(string $dado)
    {
        try {
        $this->setPotenciaPainel($dado);
        } catch (\ErrorException $e) {
            throw new \DomainException();
        }
    }

    public function precoFornecedor(string $dado)
    {
        $this->setPrecoFornecedor($dado);
    }

    public function fornecedor(string $dado)
    {
        $fornecedor = $this->indices['EDELTEC'];
        $this->setFornecedor($fornecedor);
    }

    public function tensao(string $dado)
    {
        $this->setTensao(intval($dado));
    }

    public function estrutura(string $dado)
    {
        $estrutura = $this->indices[$dado];
        $this->setEstrutura($estrutura);
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
