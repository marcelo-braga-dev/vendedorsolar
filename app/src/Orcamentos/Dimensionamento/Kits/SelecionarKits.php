<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

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
            (new CalculaPrecoVenda())->calculaPrecoKits($item, $this->qtdKits, $this->estado);
            if ($this->dados->getIncluirTrafo()) $this->trafo->analizaTrafo($item, $this->tensao);

            $item->geracao = $this->dados->calcularGeracao($item->potencia_kit);
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
}
