<x-layout menu="financeiro" submenu="bancos">
    <x-body title="Bancos" url-button="{{ route('admin.configs.bancos.index') }}">
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('admin.configs.bancos.update', $banco->id) }}"> @csrf @method('PUT')
            <div class="row">
                <div class="col-12">
                    <x-inputs.input label="Nome do Banco" name="nome" type="text" value="{{ $banco->nome }}"
                                    required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-3">
                    <x-inputs.input label="Qtd. Parcelas" name="qtd_parcelas" type="number"
                                    value="{{ $banco->qtd_parcelas }}" required></x-inputs.input>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.input-box-right box="%" label="Juros Mensal" name="juros_mensal"
                                              value="{{ $banco->juros_mensal }}"
                                              type="number" step="0.001" required></x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.input-box-right box="meses" label="Carência" name="carencia"
                                              value="{{ $banco->carencia }}"
                                              type="number" required></x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.select name="status" label="Status">
                        <option value="0">Desativado</option>
                        <option value="1" @if ($banco->status) selected @endif>Ativo</option>
                    </x-inputs.select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-control-label d-block">Logo</label>
                    <img class="mb-3" src="{{ asset('storage') . '/' . $banco->img_logo }}" alt="logo" width="180">
                    <input type="file" name="img_logo" class="form-control">
                </div>
            </div>
            <div class="row justify-content-between pt-3">
                <div class="col-4"></div>
                <div class="col-4 mx-auto mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                <div class="col-4 text-right">
                    <form>
                        <button type="button" class="btn btn-link text-danger" data-toggle="modal"
                                data-target="#modalExcluirMarca">
                            Excluir
                        </button>
                    </form>
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
                          action="{{ route('admin.configs.bancos.destroy', $banco->id) }}"> @csrf @method('DELETE')
                        <div class="modal-body">
                            Tem certeza que deseja excluir?
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
