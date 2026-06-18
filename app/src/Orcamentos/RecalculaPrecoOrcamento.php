<?php

namespace App\src\Orcamentos;

use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\Http\Requests\Orcamento\ConvencionalRequest;
use App\Models\Kits;
use App\Models\Trafos;
use App\src\Orcamentos\Dimensionamento\Convencional\Convencional;
use App\src\Orcamentos\Dimensionamento\Convencional\ConvencionalDados;
use App\src\Orcamentos\Dimensionamento\Kits\CalculaPrecoVenda;

/**
 * Recalcula preço e geração no servidor a partir do kit real e das margens
 * vigentes, em vez de confiar nos valores hidden enviados pelo formulário
 * (que podem ser editados pelo cliente antes do envio). Reaproveita a mesma
 * lógica de irradiação/correção/perda de orientação/PR e margens já usada na
 * tela de sugestão de kits (SelecionarKits::preencheKits()).
 */
class RecalculaPrecoOrcamento
{
    private float $precoCliente;
    private float $geracao;

    public function __construct(CadastrarOrcamentoRequest $request)
    {
        $kit = Kits::findOrFail($request->id_kit);
        $qtdKits = (int) $request->qtd_kits;

        $dimensRequest = new ConvencionalRequest();
        $dimensRequest->cidade = $request->cidade;
        $dimensRequest->orientacao = $request->orientacao;
        $dimensRequest->estrutura = $request->estrutura;
        $dimensRequest->tensao = $request->tensao;
        $dimensRequest->qtd_kits = $qtdKits;
        $dimensRequest->consumo = $request->consumo;

        $dadosDimensionamento = new ConvencionalDados($dimensRequest);
        $dimensionamento = new Convencional($dadosDimensionamento);

        (new CalculaPrecoVenda())->calculaPrecoKits($kit, $qtdKits, $dadosDimensionamento->getEstado());

        $precoCliente = (float) $kit->preco_cliente;

        if (!empty($request->trafo)) {
            $trafo = Trafos::find($request->trafo);
            if ($trafo) {
                $precoCliente += (float) $trafo->preco_cliente;
            }
        }

        $this->precoCliente = $precoCliente;
        $this->geracao = $dimensionamento->calcularGeracao($kit->potencia_kit * $qtdKits);
    }

    public function getPrecoCliente(): float
    {
        return $this->precoCliente;
    }

    public function getGeracao(): float
    {
        return $this->geracao;
    }
}
