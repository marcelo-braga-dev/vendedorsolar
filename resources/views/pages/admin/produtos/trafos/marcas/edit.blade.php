<x-layout menu="produtos" submenu="paineis">
    <x-body title="Editar Informações do Transformador" url-button="{{ route('admin.produtos.trafos-marcas.index') }}">
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('admin.produtos.trafos-marcas.update', $produto->id) }}"> @csrf @method('PUT')
            <div class="row mb-3">
                <div class="col-12">
                    <x-inputs.input label="Marca"
                                    value="{{ $produto->nome }}" type="text" name="nome" required></x-inputs.input>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <x-inputs.textarea label="Garantia" name="garantia">{{ $produto->garantia }}</x-inputs.textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-inputs.file name="img_logo" label="Logo" url="{{ $produto->img_logo }}"></x-inputs.file>
                </div>
                <div class="col-md-6">
                    <x-inputs.file name="img_produto" label="Produto" url="{{ $produto->img_produto }}"></x-inputs.file>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 text-center">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
                <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-link text-danger" data-toggle="modal"
                            data-target="#modalExcluirMarca">
                        Excluir Marca
                    </button>
                </div>
            </div>
        </form>

        {{-- Modal Excluir Marca--}}
        <div class="modal fade" id="modalExcluirMarca" tabindex="-1" role="dialog"
             aria-labelledby="modalExcluirMarcaTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Excluir Marca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST"
                          action="{{ route('admin.produtos.trafos-marcas.destroy', $produto->id) }}"> @csrf @method('DELETE')
                        <div class="modal-body">
                            Tem certeza que deseja excluir essa marca de produtos?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-body>
</x-layout>
