<x-layout menu="orcamentos">
    <x-body title="Orçamento"
            url-button="{{ route('admin.orcamentos.show', $orcamento->id) }}">
        <form method="POST" action="{{ route('admin.orcamento.status.update', $orcamento->id) }}">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.select label="Status do Orçamento:" name="status" required>
                        @foreach($todosStatus as $status => $nomeStatus)
                            <option value="{{ $status }}"
                                    @if ($orcamento->status == $status) selected @endif>{{ $nomeStatus }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-3">
                    <x-inputs.select label="Vendedor pode Editar Dados?" name="bloqueio_vendedor" required>
                        <option value="0">Sim</option>
                        <option value="1" @if($edicaoVendedor) selected @endif>Não</option>
                    </x-inputs.select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <x-inputs.textarea label="Anotações/Observações:" required
                                       name="anotacoes">{{ $orcamento->anotacoes }}</x-inputs.textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-auto mx-auto p-3">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
