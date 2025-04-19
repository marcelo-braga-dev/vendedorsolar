<x-layout menu="orcamentos" submenu="">
    <x-body title="Informações do Orçamento">
        <div class="row mb-4 justify-content-end">
            <div class="col-md-auto mb-3">
                <a class="btn btn-primary btn-block btn-sm"
                   href="{{ route('admin.orcamento.vistoria.show', $orcamento->id) }}">
                    <i class="fas fa-camera"></i> Vistoria
                </a>
            </div>
            <div class="col-md-auto mb-3">
                <a class="btn btn-primary btn-block btn-sm"
                   href="{{ route('admin.orcamento.aprovacao.show', $orcamento->id) }}">
                    <i class="fas fa-check"></i> Dados para Aprovação
                </a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-md-4 mb-3">
                <div class="card card-stats shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Valor Final</h5>
                                <span class="h2 font-weight-bold mb-0">
                                    R$ {{ convert_float_money($orcamento->preco_cliente) }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card card-stats shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Geração Estimada</h5>
                                <span class="h2 font-weight-bold mb-0">
                                    {{ convert_float_money($orcamento->geracao, 0) }} <small>kWh/mês</small>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card card-stats shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Potência do Kit</h5>
                                <span class="h2 font-weight-bold mb-0">
                                    {{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits, 3) }} <small>kWp</small>
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                    <i class="fas fa-solar-panel"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dados Orcamento --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block"><b>ID do Orçamento:</b> #{{ $orcamento->id }}</small>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block">
                                            <b>Status:</b> {{ getStatusOrcamentos($orcamento->status) }}
                                        </small>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block">
                                            <b>Data Criação:</b>
                                            {{ date('d/m/Y H:i', strtotime($orcamento->created_at)) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="row align-items-center">
                                    <div class="col-md-3 mb-3">
                                        <form method="POST" action="{{ route('orcamento.pdf') }}" target="_blank"> @csrf
                                            <input type="hidden" name="id" value="{{ $orcamento->id }}">
                                            <input type="hidden" name="grafico_geracao" id="grafico_geracao">
                                            <input type="hidden" name="grafico_payback" id="grafico_payback">
                                            <button type="submit" class="btn btn-danger btn-block">
                                                <i class="fas fa-file-pdf text-lg pr-2"></i> Abrir PDF
                                            </button>
                                        </form>
                                        <button onclick="generatePdf()">Gerar PDF</button>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a class="btn btn-success btn-block"
                                           href="{{ route('admin.orcamentos.edit', $orcamento->id) }}">
                                            <i class="fas fa-edit pr-2"></i>EDITAR
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a class="btn btn-warning btn-block"
                                           href="{{ route('admin.orcamento.status.edit', $orcamento->id) }}">
                                            <i class="fas fa-circle pr-2"></i>Alterar Status
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Anotacoes--}}
        @if (!empty($orcamento->anotacoes))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-auto">
                                    <small class="d-block"><b>Anotações:</b></small>
                                    <small>{{ $orcamento->anotacoes }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Cliente --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="row mb-2">
                                    <div class="col-auto">
                                        <span><b>Cliente:</b> {{ getNomeCliente($orcamento->clientes_id) }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <small class="d-block"><b>E-mail:</b> {{ $dadosCliente['email'] ?? '' }}</small>
                                    </div>
                                    <div class="col-md-auto">
                                        <small class="d-block"><b>Celular:</b> {{ $dadosCliente['celular'] ?? '' }}
                                        </small>
                                    </div>
                                    <div class="col-md-auto">
                                        <small class="d-block"><b>Telefone:</b> {{ $dadosCliente['telefone'] ?? '' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Vendedor --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-md-10">
                                <div class="row mb-3">
                                    <div class="col-auto">
                                        <span><b>Representante:</b> {{ usuario($orcamento->users_id)->name }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-auto">
                                        <small
                                            class="d-block"><b>E-mail:</b> {{ usuario($orcamento->users_id)->email ?? '' }}
                                        </small>
                                    </div>
                                    <div class="col-md-auto">
                                        <small class="d-block"><b>Celular:</b> {{ $dadosVendedor['celular'] ?? '-' }}
                                        </small>
                                    </div>
                                    <div class="col-md-auto">
                                        <small class="d-block"><b>Telefone:</b> {{ $dadosVendedor['telefone'] ?? '-' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Comissão do Vendedor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span class="d-block">
                            Valor do Orçamento: R$ {{ convert_float_money($orcamento->preco_cliente) }}
                        </span>
                        <span class="d-block">
                            Margem de comissão: {{ $orcamentoKit->taxa_comissao }}%
                        </span>
                        <span class="d-block">
                            Comissão:
                            R$ {{ convert_float_money($comissao) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Link de Compartilhamento do Orçamento</h4>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="link"
                                   value="{{ route('api.orcamento.show', $orcamento->token) }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" id="url" type="button">
                                    Copiar Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Estabelecimento --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body pb-0">
                        <x-tables.table-default>
                            <x-slot name="head">
                                Informações do Local da Instalação
                            </x-slot>
                            <x-slot name="body">
                                @if ($metas['consumo'])
                                    <tr>
                                        <td>Média Consumo</td>
                                        <td>{{ $metas['consumo'] }} kWh/mês</td>
                                    </tr>
                                @endif
                                @if ($metas['consumo_fora_ponta'])
                                    <tr>
                                        <td>Média Consumo <br>Fora da Ponta</td>
                                        <td>{{ $metas['consumo_fora_ponta'] }} kWh/mês</td>
                                    </tr>
                                    <tr>
                                        <td>Média Consumo <br>na Ponta</td>
                                        <td>{{ $metas['consumo_ponta'] }} kWh/mês</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Localidade</td>
                                    <td>{{ getCidadeEstado($orcamento->cidade) }}</td>
                                </tr>
                                <tr>
                                    <td>Tensão</td>
                                    <td>{{ $metas['tensao'] }} V</td>
                                </tr>
                                <tr>
                                    <td>Estrutura</td>
                                    <td style="white-space: normal">{{ getEstrutura($metas['estrutura']) }}</td>
                                </tr>
                                <tr>
                                    <td>Direção da Instalação</td>
                                    <td>{{ getDirecaoInstalacao($metas['orientacao']) }}</td>
                                </tr>
                                <tr>
                                    <td>Irradiação Solar</td>
                                    <td>{{ convert_float_money(getIrradiacao($orcamento->cidade)) }} kWh/m²</td>
                                </tr>
                            </x-slot>
                        </x-tables.table-default>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body pb-0">
                        <small class="d-block">Modelo do Kit</small>
                        <p><b>{{ $orcamentoKit->qtd_kits }}x {{ $kit->modelo }}</b></p>
                        <x-tables.table-default>
                            <x-slot name="head"></x-slot>
                            <x-slot name="body">
                                <tr class="border-top">
                                    <th>ID do Kit</th>
                                    <td>#{{ $kit->id }}</td>
                                </tr>
                                <tr>
                                    <th>Potência Total do Kit</th>
                                    <td>{{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits, 3) }}kWp
                                    </td>
                                </tr>
                                <tr>
                                    <th>Potência dos Painéis</th>
                                    <td>{{ $kit->potencia_painel }} W</td>
                                </tr>
                                <tr>
                                    <th>Tensão de Saída</th>
                                    <td>{{ $kit->tensao }} V</td>
                                </tr>
                                <tr>
                                    <th>Marca dos Painés</th>
                                    <td>{{ $imagens[$kit->marca_painel]['nome'] }}</td>
                                </tr>
                                <tr>
                                    <th>Marca do Inversor</th>
                                    <td>{{ $imagens[$kit->marca_inversor]['nome'] }}</td>
                                </tr>
                            </x-slot>
                        </x-tables.table-default>
                        <div class="row mb-4 px-4">
                            <div class="col-6 text-center">
                                <img class="img-thumbnail"
                                     src="{{ asset('storage') . '/' . $imagens[$kit->marca_painel]['logo'] }}"
                                     alt="logo painel">
                                <small class="d-block">Painéis</small>
                            </div>
                            <div class="col-6 text-center">
                                <img class="img-thumbnail"
                                     src="{{ asset('storage') . '/' . $imagens[$kit->marca_inversor]['logo'] }}"
                                     alt="logo inversor">
                                <small class="d-block">Inversor</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trafo --}}
        @if(!empty($trafo))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4>Transformador</h4>
                            <small class="d-block">modelo</small>
                            <span class="d-block">{{ $trafo->modelo }}</span>
                            <span>Valor: R$ {{ convert_float_money($trafo->preco_cliente) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Graficos Geracao --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body pb-0 img-thumbnail">
                        <x-graficos.geracao-fotovoltaica geracao="{{ $orcamento->geracao }}"
                                                         cidade="{{ $orcamento->cidade }}"></x-graficos.geracao-fotovoltaica>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payback --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body pb-0">
                        <x-graficos.payback-fotovoltaico
                            preco-cliente="{{ $orcamento->preco_cliente }}"></x-graficos.payback-fotovoltaico>
                    </div>
                </div>
            </div>
        </div>
    </x-body>

    @push('js')
        <script>
            $("#url").click(function () {
                $('#link').select();

                document.execCommand('copy');
            })
        </script>
        <script>
            async function generatePdf() {
                //const htmlContent = document.getElementById('proposal-content').innerHTML;

                try {
                    const response = await fetch("{{ route('orcamento.pdf') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                       body: JSON.stringify({ idOrcamento: 1 })
                    });

                    const data = await response.json();
                    const url = data.urlPdf;

                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'proposta_comercial.pdf');
                    document.body.appendChild(link);
                    link.click();
                } catch (error) {
                    console.log(error)
                    // console.error('Erro ao gerar PDF:', error);
                }
            }
        </script>
    @endpush
</x-layout>

