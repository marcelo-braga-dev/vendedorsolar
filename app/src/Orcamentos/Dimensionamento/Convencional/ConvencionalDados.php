<?php

namespace App\src\Orcamentos\Dimensionamento\Convencional;

use App\Http\Requests\Orcamento\ConvencionalRequest;
use App\Models\IrradiacaoSolar;
use App\src\Orcamentos\Dimensionamento\DadosDimensionamento;

class ConvencionalDados implements DadosDimensionamento
{
    private $consumo;
    private $cidade;
    private $irradiacao;
    private $correcao;
    private $tensao;
    private $estrutura;

    public function __construct(ConvencionalRequest $request)
    {
        $this->cidade = $request->cidade;
        $this->consumo = $request->consumo;
        $this->tensao = $request->tensao;
        $this->estrutura = $request->estrutura;
        $this->irradiacao = $this->setIrradiacao($request->cidade);
        $this->correcao = $this->setCorrecaoCalculo();
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

    public function getConsumo(): float
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
}
