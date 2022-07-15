<x-layout menu="clientes" submenu="leads">
    <x-body title="Informações do Leads FINALIZADO" url-button="back">
        <div class="row mb-3">
            <div class="col-md-6">
                <span class="d-block">Nome: {{ $lead->nome }}</span>
                <span class="d-block">Telefone: {{ $lead->telefone }}</span>
                <span class="d-block">Email: {{ $lead->email }}</span>
                <span class="d-block">Cidade: {{ $lead->cidade . '/' . $lead->estado }}</span>
                <span class="d-block">Data: {{ date('d/m/Y H:i:s', strtotime($lead->created_at)) }}</span>
                <span class="d-block">Status: {{ getStatusLead($lead->status) }}</span>
            </div>
            <div class="col-md-6">
                <span class="d-block">Consumo: {{ $lead->consumo ?? 'Não informado' }}</span>
            </div>
        </div>
        <form method="POST" action="{{ route('vendedor.leads.update', $lead->id) }}"> @csrf @method('PUT')
            <div class="row mb-3">
                <div class="col-md-3">
                    <x-inputs.select name="status" label="Status do atendimento" required>
                        @foreach($status as $chave => $nome)
                            <option value="{{ $chave }}" @if($lead->status == $chave) selected @endif>{{ $nome }}</option>
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
