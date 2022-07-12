<?php

namespace App\src\Integracoes\Aldo;

use App\src\Integracoes\Aldo\AcoesAoLerArquivo\PesquisaTags;
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
        //(new ManipulaZip())->removerXML();

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
        echo 'INICIO: ' . date('d/m H:i:s') . '<br>';

        // $dirXML = app_path('src\Integracoes\Aldo\RepositorioZip\extract\Shares\Integracao\221726.xml');
        $dirXML = $this->getZip();
        $indices = $this->indices();


        $separar = new SeparaProdutosXML($dirXML, $indices, new Produto());
        $separar->executar();

        (new ManipulaZip())->removerXML();

        echo 'FIM: ' . date('H:i:s') . '<br>';
    }
}
