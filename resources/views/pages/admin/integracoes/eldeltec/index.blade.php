<x-layout menu="integracoes" submenu="eldeltec">
    <x-body title="Integracão Eldeltec">
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
