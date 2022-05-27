<x-layout menu="fornecedores" submenu="fornecedores_cadastrados">
    <x-body title="Editar Fornecedor" url-button="{{ route('admin.fornecedores.index') }}">
        <div class="row">
            <div class="col-md-6 mb-4">
                <span><b>Nome da Empresa: </b>{{ $fornecedor->nome }}</span>
            </div>
            <div class="col-md-6 mb-4">
                <span><b>CNPJ: </b>{{ $fornecedor->cnpj }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <span><b>Representante: </b>{{ $fornecedor->representante }}</span>
            </div>
            <div class="col-md-6 mb-4">
                <span><b>E-mail de contato: </b>{{ $fornecedor->email }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <span><b>Celular: </b>{{ $fornecedor->celular }}</span>
            </div>
            <div class="col-md-6 mb-4">
                <span><b>Telefone: </b>{{ $fornecedor->telefone }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <span><b>Site/Plataforma: </b>{{ $fornecedor->site }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <span><b>Anotações: </b>{{ $fornecedor->anotacoes }}</span>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-auto mb-4">
                <a class="btn btn-primary"
                   href="{{ route('admin.fornecedores.edit', $fornecedor->id) }}">Editar</a>
            </div>
            <div class="col-auto text-right mb-4">
                <button type="button" class="btn btn-link text-danger" data-toggle="modal"
                        data-target="#modalExcluirMarca">
                    Excluir Fornecedor
                </button>
            </div>
        </div>

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
                          action="{{ route('admin.fornecedores.destroy', $fornecedor->id) }}"> @csrf @method('DELETE')
                        <div class="modal-body">
                            Tem certeza que deseja excluir esse representante?
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
