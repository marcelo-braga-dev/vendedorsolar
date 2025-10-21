<?php

namespace App\Http\Controllers\Vendedor\Contratos;

use App\Models\Clientes;
use App\Models\Contratos;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\OrcamentosInfos;
use App\Models\OrcamentosKits;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ContratosController
{
    public function index()
    {
        $items = (new Contratos())->newQuery()
            ->where('users_id', id_usuario_atual())
            ->orderByDesc('id')->get();

        return view('pages.vendedor.contratos.index', compact('items'));
    }

    public function edit($id)
    {
        $orcamento = (new Orcamentos())->newQuery()->findOrFail($id);

        $orcamentoKit = (new OrcamentosKits())->newQuery()
            ->where('orcamentos_id', $orcamento->id)->first();

        $orcamentoInfo = (new OrcamentosInfos())->newQuery()
            ->where('orcamentos_id', $orcamento->id)->first();

        $kit = (new Kits())->newQuery()->find($orcamentoKit->kits_id);

        $produtos = (new Produtos())->getDados();
        $cliente = (new Clientes())->find($orcamento->clientes_id);

        return view('pages.vendedor.contratos.create',
            compact('orcamento', 'orcamentoKit', 'kit', 'produtos', 'orcamentoInfo', 'cliente'));
    }

    public function store(Request $request)
    {
        $dados = (new Contratos());
        $dados->orcamentos_id = $request->id;
        $dados->users_id = id_usuario_atual();
        $dados->nome_cliente = $request->nome;
        $dados->documento_cliente = $request->documento;
        $dados->endereco = $request->endereco;
//        $dados->potencia_projeto = $request->potencia;
//        $dados->qtd_paineis = $request->qtd_paineis;
//        $dados->qtd_inversor = $request->qtd_inversores;
//        $dados->potencia_inversor = $request->potencia_inversor;
//        $dados->consumo = $request->consumo;
//        $dados->garantia_paineis = $request->garantia_paineis;
//        $dados->garantia_inversor = $request->garantia_inversores;
//        $dados->valor_projeto = $request->valor;
//        $dados->formas_pagamento = $request->formas_pagamento;
//        $dados->clausulas_adicionais = $request->clausulas;
//        $dados->geracao = $request->geracao;
//        $dados->produtos = $request->produtos;
        $dados->push();

        return redirect()->route('contratos.contratos-gerados.show', $dados->id);
    }

    public function show($id)
    {
        $contrato = (new Contratos())->newQuery()->findOrFail($id);

        return view('pages.vendedor.contratos.show', compact('contrato'));
    }
}
