<?php

namespace App\src\PDF\Solmar;

use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\Kits;
use App\Models\OrcamentosKits;
use App\Models\Orcamentos;
use App\Models\Trafos;
use App\Models\User;

abstract class DadosOrcamento
{
    private int $idOrcamento;
    private $orcamento;
    private $cliente;
    private $kit;
    private $vendedor;
    private $orcamentoKits;
    private $trafo;
    private $dadosCliente;

    public function __construct(int $idOrcamento)
    {
        $this->idOrcamento = $idOrcamento;
        $this->orcamento = $this->setOrcamento();
        $this->cliente = $this->setCliente();
        $this->vendedor = $this->setVendedor();
        $this->orcamentoKits = $this->setOrcamentoKits($idOrcamento);
        $this->kit = $this->setKit();
        $this->trafo = $this->setTrafo($this->orcamento->trafo);
        $this->dadosCliente = $this->setDadosCliente($this->orcamento->clientes_id);
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

    public function getKit()
    {
        return $this->kit;
    }

    public function getTrafo()
    {
        return $this->trafo;
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

    private function setTrafo($id)
    {
        return (new Trafos())->newQuery()
            ->find($id);
    }

    public function getDadosCliente()
    {
        return $this->dadosCliente;
    }

    public function setDadosCliente($id)
    {
        return (new ClientesMetas())->values($id);
    }
}
