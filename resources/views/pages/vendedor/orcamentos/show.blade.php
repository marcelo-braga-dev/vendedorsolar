<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Informações do Orçamento">
        <div class="row mb-4 justify-content-end">
            <div class="col-md-auto mb-3">
                <a class="btn btn-primary btn-block btn-sm"
                   href="{{ route('vendedor.orcamento.vistoria.show', $orcamento->id) }}">
                    <i class="fas fa-camera"></i> Vistoria
                </a>
            </div>
            <div class="col-md-auto mb-3">
                <a class="btn btn-primary btn-block btn-sm"
                   href="{{ route('vendedor.orcamento.aprovacao.show', $orcamento->id) }}">
                    <i class="fas fa-check"></i> Dados para Aprovação
                </a>
            </div>
            @if (implementadoContratos())
                <div class="col-md-auto mb-3">
                    <a class="btn btn-primary btn-block btn-sm"
                       href="{{ route('vendedor.contratos.edit', $orcamento->id) }}">
                        <i class="fas fa-file"></i> Gerar Contrato
                    </a>
                </div>
            @endif
        </div>
        <div class="row mb-3">
            <div class="col-12 col-md-4 mb-3">
                <div class="card card-stats shadow">
                    <!-- Card body -->
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
                    <!-- Card body -->
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
                                <h5 class="card-title text-uppercase text-muted mb-0">
                                    Potência do Kit
                                </h5>
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
        {{-- Cliente --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-auto mb-3">
                                <div class="row">
                                    <div class="col-auto">
                                        <h3>Cliente: {{ getNomeCliente($orcamento->clientes_id) }}</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block">ID do Orçamento: #{{ $orcamento->id }}</small>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <small
                                            class="d-block">Status: {{ getStatusOrcamentos($orcamento->status) }}</small>
                                    </div>
                                    <div class="col-12 col-md-auto">
                                        <small class="d-block">
                                            Data Criação: {{ date('d/m/Y H:i', strtotime($orcamento->created_at)) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <input type="hidden" name="grafico_geracao" id="grafico_geracao">
                                        <input type="hidden" name="grafico_payback" id="grafico_payback">

                                        <!-- Botão que aciona o envio do PDF -->
                                        <button id="btnGerarPdf"
                                                class="btn btn-danger w-100 d-flex align-items-center justify-content-center"
                                                onclick="generatePdf()"
                                        >
                                            <i class="fas fa-file-pdf pr-2"></i> Abrir PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Anotações --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <form method="POST"
                          action="{{ route('vendedor.orcamento.update', $orcamento->id) }}"> @csrf @method('PUT')
                        <div class="card-body text-center">
                            <div class="row">
                                <x-inputs.textarea label="Anotações"
                                                   name="anotacoes">{{ $metas['anotacoes'] }}</x-inputs.textarea>
                            </div>
                            <button class="btn btn-success">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Link de Compartilhamento--}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Link de compartilhamento do Orçamento</h4>
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

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Comissão</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span class="d-block">
                            Valor do Orçamento: R$ {{ convert_float_money($orcamento->preco_cliente) }}
                        </span>
                        <span class="d-block">
                            Sua margem de comissão: {{ $orcamentoKit->taxa_comissao }}%
                        </span>
                        <span class="d-block">
                            Comissão:
                            R$ {{ convert_float_money($comissao) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Estabelecimento --}}
        <div class="row">
            <div class="col-md-6 mb-3">
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
                                    <tr>
                                        <td>Demanda Contratada</td>
                                        <td>{{ $metas['demanda'] }} kWh/mês</td>
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

            <div class="col-md-6 mb-3">
                <div class="card shadow">
                    <div class="card-body pb-0">
                        <small class="d-block">Modelo do Kit</small>
                        <p><b>{{ $orcamentoKit->qtd_kits }}x {{ $kit->modelo }}</b></p>
                        <x-tables.table-default>
                            <x-slot name="head"></x-slot>
                            <x-slot name="body">
                                <tr class="border-top">
                                    <td>ID do Kit</td>
                                    <td>#{{ $kit->id }}</td>
                                </tr>
                                <tr>
                                    <td>Potência total</td>
                                    <td>{{ convert_float_money($kit->potencia_kit * $orcamentoKit->qtd_kits) }} kWp</td>
                                </tr>
                                <tr>
                                    <td>Potência dos Painéis</td>
                                    <td>{{ $kit->potencia_painel }} W</td>
                                </tr>
                                <tr>
                                    <td>Tensão de Saída</td>
                                    <td>{{ $kit->tensao }} V</td>
                                </tr>
                                <tr>
                                    <td>Marca dos Painés</td>
                                    <td>{{ $imagens[$kit->marca_painel]['nome'] }}</td>
                                </tr>
                                <tr>
                                    <td>Marca do Inversor</td>
                                    <td>{{ $imagens[$kit->marca_inversor]['nome'] }}</td>
                                </tr>
                            </x-slot>
                        </x-tables.table-default>
                        <div class="row mb-4 px-4">
                            <div class="col-6">
                                <img class="img-thumbnail"
                                     src="{{ asset('storage') . '/' . $imagens[$kit->marca_painel]['logo'] }}"
                                     alt="logo painel">
                            </div>
                            <div class="col-6">
                                <img class="img-thumbnail"
                                     src="{{ asset('storage') . '/' . $imagens[$kit->marca_inversor]['logo'] }}"
                                     alt="logo inversor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produtos --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h4>Quantidade de Kits: {{ $orcamentoKit->qtd_kits }} kits</h4>
                        <h5>Produtos de cada Kit:</h5>
                        @php($linhas = explode('<br />', nl2br($orcamentoKit->produtos)))
                        <ul>
                            @foreach($linhas as $linha)
                                <li>{{ $linha }}</li>
                            @endforeach
                        </ul>
                        @if ($kit->observacoes)
                            <h5>Observações:</h5>
                            <span>{{ $kit->observacoes }}</span>
                        @endif
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
                    <div class="card-body pb-0">
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
                const graficoGeracao = document.getElementById('grafico_geracao').value;
                const graficoPayback = document.getElementById('grafico_payback').value;

                const payload = {
                    id: {{ $orcamento->id }},
                    grafico_geracao: graficoGeracao,
                    grafico_payback: graficoPayback
                };

                try {
                    const response = await fetch("{{ route('orcamento.pdf') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();
                    const url = data.urlPdf;

                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', "{{ getNomeCliente($orcamento->clientes_id).'_'.$orcamento->geracao.'kwh.pdf'}}");
                    link.setAttribute('target', '_blank');
                    document.body.appendChild(link);
                    link.click();
                } catch (error) {
                    console.error('Erro ao gerar PDF:', error);
                }
            }
        </script>
    @endpush
</x-layout>
