<?php

namespace App\Services\IntegracoesDistribuidoras\Edeltec;

use App\Models\Estruturas;
use App\Models\IntegracaoEdeltec;
use App\Models\Produtos;
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
        $this->setMarcaInversor($this->resolverIndice($dado, 'inversor'));
    }

    public function marcaPainel(string $dado)
    {
        $this->setMarcaPainel($this->resolverIndice($dado, 'painel'));
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
        $this->setEstrutura($this->resolverIndice($dado, 'estrutura'));
    }

    /**
     * Resolve o ID de uma marca de inversor/painel ou de uma estrutura pelo nome
     * vindo da Edeltec. Quando o nome ainda não está mapeado, cadastra
     * automaticamente (em `produtos` ou `estruturas`) e registra o mapeamento em
     * `integracao_edeltecs`, para que a importação não precise de cadastro manual
     * prévio nem falhe por marca/estrutura desconhecida.
     */
    private function resolverIndice(string $nome, string $tipo): int
    {
        if (isset($this->indices[$nome])) {
            return $this->indices[$nome];
        }

        $id = $tipo === 'estrutura'
            ? Estruturas::query()->create(['nome' => $nome])->id
            : Produtos::query()->create(['tipo' => $tipo, 'nome' => $nome])->id;

        IntegracaoEdeltec::query()->create([
            'produto_id' => $id,
            'categoria'  => $tipo === 'estrutura' ? 'estrutura' : 'produto',
            'nome'       => $nome,
        ]);

        $this->indices->put($nome, $id);

        return $id;
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
