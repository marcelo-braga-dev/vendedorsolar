<x-layout menu="produtos" submenu="inversores">
    <x-body title="Cadastrar Marca de Inversor" url-button="back">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.produtos.inversores.store') }}"> @csrf
            <div class="row">
                <div class="col-md-9">
                    <x-inputs.input label="Nome da Empresa" name="nome" type="text" required></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.select label="Categoria do Inversor" name="categoria" required>
                        <option value="">Selecione...</option>
                        <option value="convencional">Convencional</option>
                        <option value="microinversor">Micro Inversor</option>
                    </x-inputs.select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Garantia do Inversor" name="garantia" type="text"></x-inputs.textarea>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <span class="d-block">Imagem da Logo</span>
                    <input type="file" name="img_logo" class="form-control m-2">
                </div>
                <div class="col-md-6">
                    <span class="d-block">Imagem do Produto</span>
                    <input type="file" name="img_produto" class="form-control m-2">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cadastrar Marca</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
