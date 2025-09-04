<?php

namespace App\src\PDF\Ecovolt;

use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\Kits;
use App\Models\OrcamentosKits;
use App\Models\Orcamentos;
use App\Models\User;

abstract class DadosOrcamento
{
    private int $idOrcamento;
    private $orcamento;
    private $cliente;
    private $clienteDados;
    private $kit;
    private $vendedor;
    private $orcamentoKits;

    public function __construct(int $idOrcamento)
    {
        $this->idOrcamento = $idOrcamento;
        $this->orcamento = $this->setOrcamento();
        $this->cliente = $this->setCliente();
        $this->clienteDados = $this->setClienteDados();
        $this->vendedor = $this->setVendedor();
        $this->orcamentoKits = $this->setOrcamentoKits($idOrcamento);
        $this->kit = $this->setKit();
    }

    private function setOrcamento()
    {
        return Orcamentos::find($this->idOrcamento);
    }

    private function setCliente()
    {
        return Clientes::where([
            ['id', '=', $this->orcamento->clientes_id],
            ['users_id', '=', $this->orcamento->users_id]
        ])->first();
    }

    private function setClienteDados()
    {
        return (new ClientesMetas)->values($this->cliente->id);
    }

    private function setKit()
    {
        return Kits::find($this->orcamentoKits->kits_id);
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

    public function getClienteDados()
    {
        return $this->clienteDados;
    }

    public function getKit()
    {
        return $this->kit;
    }

    private function setOrcamentoKits($id)
    {
        return (new OrcamentosKits())->newQuery()
            ->where('orcamentos_id', $id)
            ->first();
    }

    public function getOrcamentoKit()
    {
        return $this->orcamentoKits;
    }
}
