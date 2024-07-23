<x-layout menu="produtos" submenu="paineis">
    <x-body title="Cadastrar Marca de Painel" url-button="{{ route('admin.produtos.trafos-marcas.index') }}">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.produtos.trafos-marcas.store') }}"> @csrf
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Nome da Empresa" name="nome" type="text" required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Garantia" name="garantia" type="text"></x-inputs.textarea>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <x-inputs.file name="img_logo" label="Imagem da Logo"></x-inputs.file>
                </div>
                <div class="col-md-6">
                    <x-inputs.file name="img_produto" label="Imagem do Produto"></x-inputs.file>
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cadastrar Marca</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
