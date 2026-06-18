<?php

namespace App\View\Components\Graficos;

use App\Models\CidadesEstados;
use App\Models\Concessionarias;
use App\Models\DadosDimensionamento;
use App\src\Orcamentos\Financeiro\DadosFluxoCaixa;
use App\src\Orcamentos\Financeiro\FluxoCaixaSolar;
use Carbon\Carbon;
use Illuminate\View\Component;

class PaybackFotovoltaico extends Component
{
    private float $precoCliente;
    private float $geracao;
    private int $cidade;
    private ?string $dataOrcamento;

    public function __construct(float $precoCliente, float $geracao, int $cidade, ?string $dataOrcamento = null)
    {
        $this->precoCliente = $precoCliente;
        $this->geracao = $geracao;
        $this->cidade = $cidade;
        $this->dataOrcamento = $dataOrcamento;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $precoCliente = $this->precoCliente;
        $fluxo = $this->fluxoCaixaSolar()->calcular();
        $anoPayback = $this->fluxoCaixaSolar()->anoPayback();

        return view('components.graficos.payback-fotovoltaico', compact('precoCliente', 'fluxo', 'anoPayback'));
    }

    private function fluxoCaixaSolar(): FluxoCaixaSolar
    {
        $dataReferencia = $this->dataOrcamento ? Carbon::parse($this->dataOrcamento) : Carbon::now();
        $estado = (new CidadesEstados())->getSigla($this->cidade);
        $concessionaria = (new Concessionarias())->porEstado((string) $estado);
        $config = new DadosDimensionamento();

        $dados = new DadosFluxoCaixa(
            geracaoAnual: $this->geracao * 12,
            precoCliente: $this->precoCliente,
            tarifa: (float) ($concessionaria->convencional ?? 0),
            anoReferencia: (int) $dataReferencia->format('Y'),
            dataSolicitacaoAcesso: $dataReferencia,
            degradacaoAno1: $config->getDegradacaoAno1(),
            degradacaoAnual: $config->getDegradacaoAnual(),
            inflacaoEnergetica: $config->getInflacaoEnergetica(),
            percentualFioBDaTarifa: $config->getFioBPercentualTarifa(),
        );

        return new FluxoCaixaSolar($dados);
    }
}
