<x-layout menu="leads" submenu="encaminhados">
    <x-body title="Informações do Lead ENCAMINHADO" url-button="{{ route('admin.leads.index', ['status' => 'encaminhados']) }}">
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
        <form method="POST" action="{{ route('admin.leads.update', $lead->id) }}"> @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.select label="Alterar vendedor responsável: " name="vendedor">
                        <option></option>
                        @foreach($vendedores as $item)
                            <option value="{{ $item->id }}"
                                    @if($item->id == $lead->vendedor) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-6 align-self-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
