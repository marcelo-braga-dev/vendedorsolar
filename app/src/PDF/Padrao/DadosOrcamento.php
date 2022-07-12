<?php

namespace App\src\PDF\Padrao;

use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\User;

abstract class DadosOrcamento
{
    private int $idOrcamento;
    private $orcamento;
    private $cliente;
    private $dadosCliente;
    private $kit;
    private $vendedor;


    public function __construct(int $idOrcamento)
    {
        $this->idOrcamento = $idOrcamento;
        $this->orcamento = $this->setOrcamento();
        $this->cliente = $this->setCliente();
        $this->dadosCliente = $this->setDadosCliente();
        $this->kit = $this->setKit();
        $this->vendedor = $this->setVendedor();
    }

    private function setOrcamento()
    {
        $orcamento = Orcamentos::find($this->idOrcamento);

        $orcamento->preco_cliente = convert_float_money($orcamento->preco_cliente);

        return $orcamento;

    }

    private function setCliente()
    {
        return Clientes::where([
            ['id', '=', $this->orcamento->clientes_id],
            ['users_id', '=', $this->orcamento->users_id]
        ])->first();
    }

    private function setDadosCliente()
    {
        $items = [];
        $clienteMeta = new ClientesMetas();
        $dados = $clienteMeta->newQuery()
            ->where([
                ['cliente_id', '=', $this->orcamento->clientes_id]
            ])->get(['meta', 'value']);

        foreach ($dados as $item) {
            $items[$item->meta] = $item->value;
        }

        return $items;
    }

    private function setKit()
    {
        return Kits::find($this->orcamento->kits_id);
    }

    public function getVendedor()
    {
        return $this->vendedor;
    }

    public function setVendedor()
    {
        return User::find($this->orcamento->users_id);
    }

    public function getOrcamento()
    {
        return $this->orcamento;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getDadosCliente()
    {
        return $this->dadosCliente;
    }

    public function getKit()
    {
        return $this->kit;
    }
}
