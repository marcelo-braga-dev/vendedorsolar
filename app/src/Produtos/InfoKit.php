<?php

namespace App\src\Produtos;

abstract class InfoKit
{
    abstract protected function sku(string $dado);

    abstract protected function modelo(string $dado);

    abstract protected function marcaInversor(string $dado);

    abstract protected function potenciaInversor(string $dado);

    abstract protected function potenciaPainel(string $dado);

    abstract protected function marcaPainel(string $dado);

    abstract protected function potenciaKit(string $dado);

    abstract protected function precoFornecedor(string $dado);

    abstract protected function estrutura(string $dado);

    abstract protected function produtos(string $dado);

    abstract protected function observacoes(string $dado);

    abstract protected function fornecedor(string $dado);

    abstract protected function tensao(string $dado);

    abstract protected function margem(string $potenciaKit);
}
