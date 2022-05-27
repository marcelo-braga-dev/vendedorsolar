<x-layout menu="integracoes" submenu="aldo">
    <x-body title="Integracão Aldo">
        <div class="row">
            <div class="col-6">
                <x-inputs.input label="Chave de Integração" name="chave_integracao" type="text"
                                value="{{ $chaves['chave']}}"></x-inputs.input>
            </div>
            <div class="col-6">
                <x-inputs.input label="Código de Integração" name="chave_integracao" type="text"
                                value="{{ $chaves['codigo'] }}"></x-inputs.input>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <a class="btn btn-primary" href="{{ route('admin.integracoes.aldo.pesquisar') }}">
                    Atualizar Dados de Integração
                </a>
            </div>
            <div class="col-auto">
                <a class="btn btn-link" href="{{ route('admin.integracoes.aldo.integrar') }}">
                    Integrar
                </a>
            </div>
        </div>
    </x-body>
</x-layout>
