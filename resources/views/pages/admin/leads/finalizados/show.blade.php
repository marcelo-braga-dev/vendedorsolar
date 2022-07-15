<x-layout menu="leads" submenu="finalizado">
    <x-body title="Informações do Leads FINALIZADO" url-button="back">
        <div class="row mb-3">
            <div class="col-md-6">
                <span class="d-block">Nome: {{ $lead->nome }}</span>
                <span class="d-block">Telefone: {{ $lead->telefone }}</span>
                <span class="d-block">Email: {{ $lead->email }}</span>
                <span class="d-block">Cidade: {{ $lead->cidade . '/' . $lead->estado }}</span>
                <span class="d-block">Data: {{ date('d/m/Y H:i:s', strtotime($lead->created_at)) }}</span>
                <span class="d-block">Status: {{ $lead->status }}</span>
            </div>
            <div class="col-md-6">
                <span class="d-block">Consumo: {{ $lead->consumo ?? 'Não informado' }}</span>
            </div>
        </div>
    </x-body>
</x-layout>
