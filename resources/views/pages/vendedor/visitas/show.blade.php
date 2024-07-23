<x-layout menu="visita" submenu="agendadas">
    <x-body title="Informações do Leads FINALIZADO" url-button="{{ route('vendedor.visitas.index') }}">
        <div class="row mb-3">
            <div class="col-md-6">
                <span class="d-block">Nome: {{ getNomeCliente($cliente->id) }}</span>
                <span class="d-block">Telefone: {{ $cliente->telefone }}</span>
                <span class="d-block">Email: {{ $cliente->email }}</span>
                <span class="d-block">Cidade: {{ getCidadeEstado($cliente->cidades_estados_id) }}</span>
                <span class="d-block">Data: {{ date('d/m/Y H:i:s', strtotime($cliente->created_at)) }}</span>
                <span class="d-block">Status: {{ getStatusVisitaTecnica($visita->status) }}</span>
            </div>
            <div class="col-md-6">
                <span class="d-block">Consumo: {{ $cliente->consumo ?? 'Não informado' }}</span>
            </div>
        </div>
        <form method="POST" action="{{ route('vendedor.visitas.update', $visita->id) }}"> @csrf @method('PUT')
            <div class="row mb-3">
                <div class="col-md-3">
                    <x-inputs.select name="status" label="Status do atendimento" required>
                        @foreach($status as $chave => $nome)
                            <option value="{{ $chave }}" @if($visita->status == $chave) selected @endif>{{ $nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-6 align-self-center">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
