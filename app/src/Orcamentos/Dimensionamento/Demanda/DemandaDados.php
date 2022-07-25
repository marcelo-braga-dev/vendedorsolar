<?php

namespace App\src\Orcamentos\Dimensionamento\Demanda;

use App\Models\CidadesEstados;
use App\Models\Concessionarias;
use App\Models\IrradiacaoSolar;
use App\src\Orcamentos\Dimensionamento\DadosDimensionamento;

class DemandaDados implements DadosDimensionamento
{
    private $consumoForaPonta;
    private $cidade;
    private $irradiacao;
    private $correcao;
    private $tensao;
    private $estrutura;
    private $consumoPonta;
    private $tarifas;
    private $qtdKits;
    private $incluirTrafo;

    public function __construct($request)
    {
        $this->consumoForaPonta = $request->consumo_fora_ponta;
        $this->consumoPonta = $request->consumo_ponta;
        $this->cidade = $request->cidade;
        $this->tensao = $request->tensao;
        $this->estrutura = $request->estrutura;
        $this->irradiacao = $this->setIrradiacao($request->cidade);
        $this->correcao = $this->setCorrecaoCalculo();
        $this->qtdKits = $request->qtd_kits;
        $this->tarifas = $this->setTarifas($request->concessionaria);
        $this->incluirTrafo = $request->verificar_trafo;
        $this->estado = $this->setEstado($request->cidade);
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($localidae)
    {
        return (new CidadesEstados())->getSigla($localidae);
    }

    private function setIrradiacao(int $cidade): float
    {
        return IrradiacaoSolar::find($cidade, 'media')->media;
    }

    private function setCorrecaoCalculo()
    {
        $dadosDimensionamento = new \App\Models\DadosDimensionamento();

        return $dadosDimensionamento->newQuery()
                ->where('meta', '=', 'ajuste_calculo')
                ->where('meta_key', '=', 'margem_perda')
                ->first(['meta', 'value'])->value ?? 0;
    }

    private function setTarifas(string $id)
    {
        $conc = new Concessionarias();

        return $conc->newQuery()
            ->find($id, ['ponta', 'fora_ponta']);
    }

    public function getConsumoForaPonta(): float
    {
        return $this->consumoForaPonta;
    }

    public function getIrradiacao(): float
    {
        return $this->irradiacao;
    }

    public function getCorrecaoCalculo(): int
    {
        return $this->correcao;
    }

    public function getTensao()
    {
        return $this->tensao;
    }

    public function getEstrutura()
    {
        return $this->estrutura;
    }

    public function getTarifas()
    {
        return $this->tarifas;
    }

    public function getConsumoPonta()
    {
        return $this->consumoPonta;
    }

    public function getQtdKits()
    {
        return $this->qtdKits;
    }

    public function getIncluirTrafo()
    {
        return $this->incluirTrafo;
    }
}
