<x-layout menu="produtos" submenu="trafos">
    <x-body title="Cadastrar Marca de Transformador" url-button="back">
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('admin.produtos.trafos.destroy', $marca->id) }}"> @csrf @method('DELETE')
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Nome da Empresa" name="nome" type="text"
                                    value="{{ $marca->nome }}" required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Garantia do Transformador"
                                       name="garantia">{{ $marca->garantia }}</x-inputs.textarea>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <span class="d-block">Logo</span>
                    <img class="img-fluid mb-3" src="{{ asset('storage') . '/' . $marca->img_logo }}" alt="logo">
                    <small class="d-block">atualizar:</small>
                    <input type="file" name="img_logo" class="form-control m-2">
                </div>
                <div class="col-md-6">
                    <span class="d-block">Produto</span>
                    <img class="img-fluid mb-3" src="{{ asset('storage') . '/' . $marca->img_produto }}" alt="logo">
                    <small class="d-block">atualizar:</small>
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
