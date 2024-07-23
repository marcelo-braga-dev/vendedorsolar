<?php

namespace App\src\Integracoes\Arquivos\Excel;

use App\Models\Estruturas;
use App\Models\Kits;
use App\Models\Produtos;
use App\src\Produtos\CalculoPrecos\CalcularPrecoVenda;
use App\src\Produtos\CalculoPrecos\MargensPadrao;
use App\src\Produtos\Kit;
use Illuminate\Database\QueryException;
use Ramsey\Uuid\Exception\DateTimeException;
use Shuchkin\SimpleXLSX;

class Manipular extends Kit
{
    private $idProdutos;

    public function __construct()
    {
        $this->idProdutos = $this->idProdutos();
        $this->idEstruturas = $this->idEstruturas();
    }

    public function executar(string $path, $fornecedor)
    {
        $xlsx = SimpleXLSX::parse($path);
        $rows = $xlsx->rows();
        $errors = null;

        foreach ($rows as $index => $row) {
            if ($index > 1) {
                try {
                    $this->sku($row[0]);
                    $this->modelo($row[1]);
                    $this->potenciaKit(convert_money_float($row[2]));
                    $this->marcaInversor($row[4]);
                    $this->marcaPainel($row[5]);
                    $this->potenciaInversor(10);
                    $this->potenciaPainel($row[6]);
                    $this->precoFornecedor($row[3]);
                    $this->fornecedor($fornecedor);
                    $this->estrutura($row[7]);
                    $this->tensao($row[8]);
                    $this->produtos($row[9]);
                    $this->observacoes($row[10]);
                    $this->margem(convert_money_float($row[2]));
                    $this->statusFornecedor(1);

                    if ($kit = (new Kits())->newQuery()
                        ->where('sku', $row[0])
                        ->where('fornecedor', $fornecedor)
                        ->first()) {
                        $this->atualizar($kit->id);
                    } else $this->cadastrar();
                } catch (\DomainException|QueryException $exception) {
                    $errors .= $index + 1 . ' (' . $exception->getMessage() . '), ';
                }
            }
        }
        return $errors;
    }

    protected function sku($dado)
    {
        if (empty($dado)) throw new \DomainException('código');
        $this->setSku($dado);
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
        $id = array_search($dado, $this->idProdutos);
        if (!$id) throw new \DomainException('inversor');
        $this->setMarcaInversor($id);
    }

    protected function marcaPainel(string $dado)
    {
        $id = array_search($dado, $this->idProdutos);
        if (!$id) throw new \DomainException();
        $this->setMarcaPainel($id);
    }

    protected function potenciaInversor(string $dado)
    {
        $this->setPotenciaInversor($dado);
    }

    protected function potenciaPainel(string $dado)
    {
        $this->setPotenciaPainel(intval($dado));
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
        $id = array_search($dado, $this->idEstruturas);
        if (!$id) throw new \DomainException('estrutura');
        $this->setEstrutura($id);
    }

    protected function tensao(string $dado)
    {
        $this->setTensao(intval($dado));
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

    protected function statusFornecedor(?int $status)
    {
        $this->setStatusFornecedor($status);
    }

    private function idProdutos(): array
    {
        $items = (new Produtos())->newQuery()->get();
        $produtos = [];
        foreach ($items as $item) {
            $produtos[$item->id] = $item->nome;
        }
        return $produtos;
    }

    private function idEstruturas()
    {
        $items = (new Estruturas())->newQuery()->get();
        $produtos = [];
        foreach ($items as $item) {
            $produtos[$item->id] = $item->nome;
        }
        return $produtos;
    }
}
