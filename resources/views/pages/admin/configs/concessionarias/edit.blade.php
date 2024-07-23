<x-layout menu="configs" submenu="concessionarias">
    <x-body title="Concessionarias" url-button="{{ route('admin.configs.concessionarias.index') }}">
        <form method="POST" action="{{ route('admin.configs.concessionarias.update', $item->id) }}">
            @csrf @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <span class="d-block">Concessonária: {{ $item->nome }}</span>
                    <span class="d-block">Estado: {{ $item->estado }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input-box-left box="R$" label="Tarifa Ponta" name="ponta"
                                             type="number" step="0.00001" value="{{ $item->ponta }}"></x-inputs.input-box-left>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-left box="R$" label="Tarifa Fora Ponta" name="fora_ponta"
                                             type="number" step="0.00001" value="{{ $item->fora_ponta }}"></x-inputs.input-box-left>
                </div>
            </div>
            <div class="row">
                <div class="col-auto mx-auto">
                    <button class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
