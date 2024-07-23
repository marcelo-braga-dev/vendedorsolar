<?php

namespace App\src\Integracoes\Aldo\Produtos\Infos;

class ProdutosKit
{
    public function get($arg): string
    {
        $produtos = '';

        $pattern = '/composto por:.(.+)/i';
        $resultado = preg_match_all($pattern, $arg, $produtosKit);

        if ($resultado >= 1) {
            $produtos = $produtosKit[1][0];

            $pattern = ['/\<img (.+)/i'];
            $produtos = preg_replace($pattern, '', $produtos);
            $pattern = ['/<br> <br>(.+)/i', '/<\/strong><br\/>/i'];
            $produtos = preg_replace($pattern, '', $produtos);
            $produtos = str_replace(array('<br/>', '<br>'), ";\n", $produtos);
        }

        return $produtos;
    }
}
