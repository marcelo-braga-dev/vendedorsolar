<?php

namespace App\src\Orcamentos\Dimensionamento\Convencional;

use App\Http\Requests\Orcamento\ConvencionalRequest;
use App\Models\CidadesEstados;
use App\Models\IrradiacaoSolar;
use App\src\Orcamentos\Dimensionamento\DadosDimensionamento;

class ConvencionalDados implements DadosDimensionamento
{
    private $consumo;
    private $irradiacao;
    private $correcao;
    private $tensao;
    private $estrutura;
    private $qtdKits;
    private $incluirTrafo;
    private $tipoConsumo;
    private $potenciakWP;
    private $estado;

    public function __construct(ConvencionalRequest $request)
    {
        $this->consumo = $request->consumo;
        $this->tensao = $request->tensao;
        $this->estrutura = $request->estrutura;
        $this->qtdKits = $request->qtd_kits;
        $this->incluirTrafo = $request->verificar_trafo;
        $this->tipoConsumo = $request->tipo_consumo;
        $this->potenciakWP = $request->potencia;
        $this->irradiacao = $this->setIrradiacao($request->cidade);
        $this->correcao = $this->setCorrecaoCalculo();
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
        return (new IrradiacaoSolar)->newQuery()->find($cidade, 'media')->media;
    }

    private function setCorrecaoCalculo()
    {
        $dadosDimensionamento = new \App\Models\DadosDimensionamento();

        return $dadosDimensionamento->newQuery()
            ->where('meta', '=', 'ajuste_calculo')
            ->where('meta_key', '=', 'margem_perda')
            ->first(['meta', 'value'])->value ?? 0;
    }

    public function getConsumo(): ?float
    {
        return $this->consumo;
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

    public function getQtdKits()
    {
        return $this->qtdKits;
    }

    public function getIncluirTrafo()
    {
        return $this->incluirTrafo;
    }

    public function getTipoConsumo()
    {
        return $this->tipoConsumo;
    }

    public function getPotenciakWP()
    {
        return $this->potenciakWP;
    }
}
