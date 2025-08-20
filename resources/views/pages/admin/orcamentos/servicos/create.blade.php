<x-layout menu="dimensionamento" submenu="servicos">
    <x-body title="Gerar Proposta de Serviços" url-button="">
        <form method="POST" action="{{ route('vendedor.servicos.store') }}" id="form-dimensionamento"> @csrf
            <div class="form-row border-bottom mb-3">
                {{-- Cliente --}}
                <div class="col-md-6">
                    <x-inputs.select label="Cliente" name="cliente_id" id="cliente" required>
                        <option value=""></option>
                        @foreach ($clientes as $item)
                            <option value="{{ $item->id }}" localidade="{{ $item->cidades_estados_id }}">
                                {{ getNomeCliente($item->id) }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
            </div>

            <div class="form-row border-bottom mb-3">
                <div class="col-md-3">
                    <x-inputs.input-box-left
                        label="Valor da Proposta" type="text" box="R$"
                        name="preco_proposta"
                        step="0.01"
                        data-mask="000.000.000,00"
                        data-mask-reverse="true"
                        value=""
                        required/>
                </div>
                <div class="col-md-3">
                    <x-inputs.input
                        label="Prazo da Proposta"
                        type="date"
                        name="prazo_final"
                        value=""
                        required/>
                </div>
            </div>

            <div class="form-row border-bottom mb-3">
                <div class="col-12">
                    <x-inputs.input
                        label="Título da Proposta"
                        name="titulo"
                        type="text"
                        value=""
                        required/>
                </div>
                <div class="col-12">
                    <x-inputs.textarea
                        label="Descrição da Proposta"
                        name="descricao"
                        value=""
                        rows="10"
                        required/>
                </div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-md-6 text-center">
                    <button type="submit" id="pesquisar-kits" class="btn btn-success">Gerar Proposta</button>
                </div>
            </div>
        </form>

        @push('js')
        @endpush

    </x-body>
</x-layout>
