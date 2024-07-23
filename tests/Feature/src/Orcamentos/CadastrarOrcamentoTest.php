<?php

namespace Tests\Feature\src\Orcamentos;

use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\src\Orcamentos\Orcamento;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CadastrarOrcamentoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cadastrar_orcamento()
    {
        Auth::loginUsingId(3);

        $request = new CadastrarOrcamentoRequest();
        $request->id_kit = '832';
        $request->cidade = '1';
        $request->estrutura = '1';
        $request->tensao = '380';
        $request->orientacao = 'sul';
        $request->consumo = '1234';
        $request->cliente = '2';

        $orcamento = new Orcamento();

        $res = $orcamento->cadastrar($request);

        $this->assertIsNumeric($res);
    }
}
