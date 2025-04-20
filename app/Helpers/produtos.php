<?php

use App\src\Produtos\CalculoPrecos\MargensPadrao;

if (!function_exists('calculaPrecoPrincipalKit')) {
    function calculaPrecoPrincipalKit($id)
    {
        $dados = (new \App\Models\Kits())->newQuery()->findOrFail($id);
        $margem = (new MargensPadrao($dados->potencia_kit))->getMargem();

        return $dados->preco_fornecedor * (1 + ($margem / 100));
    }
}

if (!function_exists('getMargemPrincipal')) {
    function getMargemPrincipal($id)
    {
        $dados = (new \App\Models\Kits())->newQuery()->findOrFail($id);
        return (new MargensPadrao($dados->potencia_kit))->getMargem();
    }
}

if (!function_exists('convertHtmlToText')) {
    function convertHtmlToText($html)
    {
        // Inicializa o DOM
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        $linhas = [];

        // Trata <tr>
        foreach ($dom->getElementsByTagName('tr') as $tr) {
            $colunas = [];

            foreach ($tr->childNodes as $td) {
                if ($td->nodeType === XML_ELEMENT_NODE && in_array($td->nodeName, ['td', 'th'])) {
                    // Substitui <br> e <br/> dentro da célula por \n
                    $htmlInterno = $td->ownerDocument->saveHTML($td);
                    $textoSemBr = preg_replace('/<br\s*\/?>/i', "\n", $htmlInterno);
                    // Remove outras tags e mantém apenas texto plano
                    $colunas[] = trim(strip_tags($textoSemBr));
                }
            }

            if (!empty($colunas)) {
                $linhas[] = implode(' | ', $colunas);
            }
        }

        // Caso não tenha <tr>, tenta capturar <br> fora da tabela
        if (empty($linhas)) {
            // Substitui <br> por \n e remove outras tags
            $plain = preg_replace('/<br\s*\/?>/i', "\n", $html);
            $plain = strip_tags($plain);
            return trim($plain);
        }

        return implode("\n", $linhas);
    }
}
