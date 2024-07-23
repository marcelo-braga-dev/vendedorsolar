<x-layout menu="integracoes" submenu="arquivo">
    <x-body title="Importação de Arquivo Excel">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.integracoes.arquivo.store') }}"> @csrf
            <div class="row">
                <div class="col-12">
                    <p>Integração por Planilha Excel</p>
                    <ul>
                        <li>Todos os kits precisam ter seu código único de identificação.</li>
                        <li>Os campos marcados com (*) precisam ter o mesmo nome que está na plataforma para ser
                            identificado.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.input label="Arquivo" name="arquivo" type="file" required></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.select label="Fornecedor" name="fornecedor" required>
                        <option value=""></option>
                        @foreach ($fornecedores as $item)
                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        Importar
                    </button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
