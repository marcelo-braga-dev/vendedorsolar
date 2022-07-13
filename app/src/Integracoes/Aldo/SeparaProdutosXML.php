<?php

namespace App\src\Integracoes\Aldo;

use App\src\Integracoes\Aldo\AcoesAoLerArquivo\Acoes;

class SeparaProdutosXML
{
    private $xml;
    private $indices;
    private $acao;

    public function __construct(string $xml, array $indices, Acoes $acao)
    {
        $this->xml = $xml;
        $this->indices = $indices;
        $this->acao = $acao;
    }

    public function executar()
    {
        $arquivo = fopen($this->xml, 'r');

        if ($arquivo) {
            return $this->procuraProduto($arquivo);
        }
    }

    private function procuraProduto($handle): array
    {
        $rows = '';
        $erros = [];

        while (!feof($handle)) {
            $row = fgets($handle);

            if (strpos($row, '<produto>') !== false) $rows = '';

            $rows .= $row;

            if (strpos($row, '</produto>') !== false) {

                $item = utf8_encode($rows);
                $dados = simplexml_load_string($item);

                try {
                    $this->acao->executar($dados, $this->indices);
                } catch (\DomainException $e) {
                    $erros[$e->getMessage()]  = '';
                }
            }
        }
        return $erros;
    }
}
