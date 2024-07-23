<?php

namespace Tests\Feature\src\Orcamentos\Dimensionamento\Convencional;

use App\Http\Requests\Orcamento\ConvencionalRequest;
use App\src\Orcamentos\Dimensionamento\Convencional\Convencional;
use App\src\Orcamentos\Dimensionamento\Convencional\ConvencionalDados;
use Tests\TestCase;

class DimenConvencionalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dimensionamento_convencional()
    {
        $request = new ConvencionalRequest();
        $request->cidade = 1;
        $request->estrutura = 1;
        $request->tensao = 220;
        $request->orientacao = 'norte';
        $request->consumo = 1000;

        $conv = new Convencional(new ConvencionalDados($request));
        $kits = $conv->selecionarKits();
        $this->assertIsArray($kits);
    }
}
