<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

use App\Models\MargemVendaEstruturas;
use App\Models\MargemVendaPorVendedor;
use App\Models\PrecificacaoMetas;
use App\src\Orcamentos\Dimensionamento\Dimensionamento;

class SelecionarKits extends SelecionarKitsDB
{
    private $dados;
    private $tensao;
    private $potenciaCalc;
    private $estrutura;
    private SelecionaTrafo $trafo;
    private int $qtdKits;
    private $estado;

    public function __construct(Dimensionamento $dados)
    {
        $this->qtdKits = $dados->getQtdKits();
        $this->dados = $dados;
        $this->potenciaCalc = $dados->getPotencia();
        $this->tensao = $dados->getTensao();
        $this->estrutura = $dados->getEstrutura();
        $this->estado = $dados->getEstado();
        $this->trafo = new SelecionaTrafo();
    }

    public function getKits()
    {
        $kits = $this->kits($this->potenciaCalc, $this->estrutura, $this->qtdKits);

        return $this->preencheKits($kits);
    }

    private function preencheKits($kits)
    {
        $dados = [];
        $resposta = [];

        foreach ($kits as $item) {

            $item->potencia_kit *= $this->qtdKits;
            $this->calculaPrecoKits($item);
            $item->geracao = $this->dados->calcularGeracao($item->potencia_kit);

            if ($this->dados->getIncluirTrafo()) $this->trafo->analizaTrafo($item, $this->tensao);

            $preco = $item->preco_cliente;
            $geracao = $item->geracao;

            $dados[$item->marca_inversor][$item->marca_painel]['\'' . $item->potencia_kit . '\'']['qtdKits'] = $this->qtdKits;
            $dados[$item->marca_inversor][$item->marca_painel]['\'' . $item->potencia_kit . '\'']['inversor'] = $item->marca_inversor;
            $dados[$item->marca_inversor][$item->marca_painel]['\'' . $item->potencia_kit . '\'']['painel'] = $item->marca_painel;
            $dados[$item->marca_inversor][$item->marca_painel]['\'' . $item->potencia_kit . '\'']['potencia'] = $item->potencia_kit;
            $dados[$item->marca_inversor][$item->marca_painel]['\'' . $item->potencia_kit . '\'']['geracao'] = $geracao;
            $dados[$item->marca_inversor][$item->marca_painel]['\'' . $item->potencia_kit . '\'']['kits'][] = [
                'id' => $item->id,
                'modelo' => $item->modelo,
                'potencia' => $item->potencia_kit,
                'potencia_painel' => $item->potencia_painel,
                'geracao' => $geracao,
                'preco' => $preco,
                'trafo' => $item->trafo,
                'modelo_trafo' => $item->nome_trafo,
                'preco_trafo' => $item->preco_trafo
            ];
        }

        foreach ($dados as $inversor) {
            foreach ($inversor as $painel) {
                foreach ($painel as $kit) {
                    $resposta[] = $kit;
                }
            }
        }
        return $resposta;
    }

    private function margemEstado()
    {
        return (new PrecificacaoMetas())->getEstado($this->estado);
    }

    private function margemVendedor()
    {
        return (new MargemVendaPorVendedor())->newQuery()
                ->where('users_id', '=', id_usuario_atual())
                ->first()->margem ?? 1;
    }

    private function margemEstrutura($id)
    {
        return (new MargemVendaEstruturas())->newQuery()
            ->where('estruturas_id', '=', $id)
            ->first()->margem ?? 1;
    }

    private function calculaPrecoKits($item): void
    {
        $margemEstado = $this->margemEstado();
        $margemVendedor = $this->margemVendedor();
        $margemEstrutura = $this->margemEstrutura($item->estrutura);
        $item->preco_cliente =
            $item->preco_cliente * $this->qtdKits *
            (1 + ($margemVendedor + $margemEstrutura + $margemEstado) / 100);
    }
}
