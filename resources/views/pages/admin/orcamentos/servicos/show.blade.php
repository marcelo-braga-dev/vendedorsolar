<x-layout menu="orcamentos" submenu="servicos">
    <x-body title="Proposta" class="p-0">
        <div class="row">
            <div class="col-12">
                <p>
                    <b>Cliente:</b> {{ $proposta->cliente->nome ?? $proposta->cliente->razao_social }}
                </p>
            </div>
            @if($proposta->cliente->dados->cpf)
            <div class="col-12">
                <p>
                    <b>CPF:</b> {{ $proposta->cliente->dados->cpf }}
                </p>
            </div>
            @endif
            @if($proposta->cliente->dados->cnpj)
            <div class="col-12">
                <p>
                    <b>CNPJ:</b> {{ $proposta->cliente->dados->cnpj }}
                </p>
            </div>
            @endif
            <div class="col-12">
                <p>
                    <b>Consultor:</b> {{ $proposta->vendedor->name }}
                </p>
            </div>
            <div class="col-12">
                <p>
                    <b>ID Proposta:</b> #{{ $proposta->id}}
                </p>
            </div>
        </div>

        <div class="row ">
            <div class="col-auto">
                <button id="btnGerarPdf"
                        class="btn btn-danger w-100 d-flex align-items-center justify-content-center"
                        onclick="generatePdf()"
                >
                    <i class="fas fa-file-pdf pr-2"></i> Abrir PDF
                </button>
            </div>
        </div>
    </x-body>

    <div style="margin-bottom: 130px"></div>

    <x-body title="Informações da Proposta" class="p-0">
        <div class="row">
            <div class="col">
                <p>
                    <b>Título:</b> {{ $proposta->titulo }}
                </p>
                <p>
                    <b>Valor da Proposta:</b> R$ {{ convert_float_money($proposta->valor) }}
                </p>
                <p>
                    <b>Prazo:</b> {{ $proposta->prazo_final }}
                </p>
                <p>
                    <b>Descrição:</b> {{ $proposta->descricao}}
                </p>
            </div>
        </div>
    </x-body>

    @push('js')

        <script>
            async function generatePdf() {

                const payload = {
                    id: {{ $proposta->id }},
                };

                try {
                    const response = await fetch("{{ route('admin.servicos.pdf') }}", {
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
                    link.setAttribute('download', "{{ $proposta->cliente->nome ?? $proposta->cliente->razao_social . '_' . uniqid().'.pdf'}}");
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



