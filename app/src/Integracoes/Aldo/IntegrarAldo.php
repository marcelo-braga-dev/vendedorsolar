<?php

namespace App\src\Integracoes\Aldo;

use App\Http\Controllers\Admin\Integracoes\OrigensIntegracoes;
use App\Models\IntegracaoHistorico;
use App\src\Integracoes\Aldo\AcoesAoLerArquivo\PesquisaTags;
use App\src\Integracoes\Aldo\Produtos\AtualizarStatus;
use App\src\Integracoes\Aldo\Produtos\Infos\ReferenciasAldo;
use App\src\Integracoes\Aldo\Produtos\Produto;

class IntegrarAldo
{
    public function pesquisar()
    {
        $dirXML = $this->getZip();
        $indices = $this->indices();

        $tags = new PesquisaTags();
        $separar = new SeparaProdutosXML($dirXML, $indices, $tags);
        $separar->executar();
        (new ManipulaZip())->removerXML();
        return $tags->getInfos();
    }

    private function getZip(): string
    {
        $requisao = new Requisicao();
        $zip = $requisao->getZip();

        $manipulaZip = new ManipulaZip();
        return $manipulaZip->extractZip($zip);
    }

    private function indices()
    {
        return (new ReferenciasAldo())->get();
    }

    public function integrar()
    {
        set_time_limit(0);
        $historico = $this->iniciarHistorico();

        $historico->update(['status' => '[2/5] Importando arquivo XML na Aldo.']);
        $dirXML = $this->getZip();
        $indices = $this->indices();

        $historico->update(['status' => '[3/5] Início cadastrar/atualizar kits.']);
        $erros = $this->kits($dirXML, $indices);

        $historico->update(['status' => '[4/5] Atualização dos status dos kits.', 'alertas' => $erros]);
        $this->atualizaStatus($dirXML, $indices);

        (new ManipulaZip())->removerXML();
        $msgFinal = 'Finalizado com sucesso.';
        if (!empty($erros)) $msgFinal = 'Finalizado com Alertas!';
        $historico->update(['status' => $msgFinal]);
    }

    private function iniciarHistorico()
    {
        $historico = (new IntegracaoHistorico())->newQuery();
        $idHistorico = $historico->create([
            'fornecedores_id' => 1,
            'origem' => (new OrigensIntegracoes())->getKeyAldo(),
            'status' => '[1/5] Iniciado.'
        ]);
        return $historico->find($idHistorico->id);
    }

    private function kits(string $dirXML, array $indices): string
    {
        $separar = new SeparaProdutosXML($dirXML, $indices, new Produto());
        $resposta = $separar->executar();

        $erros = '';
        foreach ($resposta as $index => $item) {
            $erros .= 'Produto não encontrado: ' . $index . "\n";
        }
        return $erros;
    }

    private function atualizaStatus(string $dirXML, array $indices): void
    {
        $atualizarStatus = new AtualizarStatus();
        $ativos = new SeparaProdutosXML($dirXML, $indices, $atualizarStatus);
        $ativos->executar();
    }
}
