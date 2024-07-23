<x-layout menu="produtos" submenu="paineis">
    <x-body title="Editar Informações do Painel" url-button="{{ route('admin.produtos.paineis.index') }}">
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('admin.produtos.paineis.update', $produto->id) }}"> @csrf @method('PUT')
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
                    <span class="d-block">Logo</span>
                    <img class="img-fluid mb-3" src="{{ asset('storage') . '/' .$produto->img_logo }}" alt="logo">
                    <small class="d-block">atualizar:</small>
                    <input type="file" name="img_logo" class="form-control m-2">
                </div>
                <div class="col-md-6">
                    <span class="d-block">Produto</span>
                    <img class="img-fluid mb-3" src="{{ asset('storage') . '/' . $produto->img_produto }}" alt="logo">
                    <small class="d-block">atualizar:</small>
                    <input type="file" name="img_produto" class="form-control m-2">
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
                          action="{{ route('admin.produtos.paineis.destroy', $produto->id) }}"> @csrf @method('DELETE')
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
