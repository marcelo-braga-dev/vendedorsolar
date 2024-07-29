<x-layout menu="integracoes" submenu="eldeltec">
    <x-body title="Integracão Eldeltec">
        <div class="row">
            <div class="col">Pagina Atual: {{$page}}</div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <a class="btn btn-link" href="{{ route('admin.integracoes.eldeltec.edit', 1) }}">
                    Pagina 1
                </a>
                <a class="btn btn-link" href="{{ route('admin.integracoes.eldeltec.edit', 2) }}">
                    Pagina 2
                </a>
                <a class="btn btn-link" href="{{ route('admin.integracoes.eldeltec.edit', 3) }}">
                    Pagina 3
                </a>
                <a class="btn btn-link" href="{{ route('admin.integracoes.eldeltec.edit', 4) }}">
                    Pagina 4
                </a>
                <a class="btn btn-link" href="{{ route('admin.integracoes.eldeltec.edit', 5) }}">
                    Pagina 5
                </a>
                <a class="btn btn-link" href="{{ route('admin.integracoes.eldeltec.edit', 6) }}">
                    Pagina 6
                </a>
                <a class="btn btn-link" href="{{ route('admin.integracoes.eldeltec.edit', 7) }}">
                    Pagina 7
                </a>
            </div>
        </div>
    </x-body>
</x-layout>
