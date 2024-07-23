<?php

namespace App\src\Integracoes\Arquivos;

use App\Http\Controllers\Admin\Integracoes\OrigensIntegracoes;
use App\Models\IntegracaoHistorico;
use App\src\Integracoes\Arquivos\Excel\Manipular;
use App\src\Integracoes\Arquivos\Excel\Upload;

class Arquivo
{
    public function executar($request)
    {
        $path = (new Upload())->upload($request);
        $errors = (new Manipular())->executar($path, $request->fornecedor);

        if ($errors){
            $errors = 'Falha na importação das linhas: ' . $errors;
            $this->historico($errors, $request->fornecedor);
            return $errors;
            // throw new \DomainException($errors);
        }
        $msg = 'Finalizado com sucesso.';
        $this->historico($msg, $request->fornecedor);
        return $msg;
    }

    private function historico($mensagem, $fornecedor)
    {
        (new IntegracaoHistorico())->newQuery()
            ->create([
                'fornecedores_id' => $fornecedor,
                'origem' => (new OrigensIntegracoes())->getKeyExcel(),
                'status' => $mensagem
            ]);
    }
}
