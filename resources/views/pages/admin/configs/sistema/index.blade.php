<x-layout menu="configs" submenu="dimensionamento">
    <x-body title="Sistema">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.configs.sistema.store') }}"> @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.file label="Logo" name="logo" url="{{ getLogoPrincipal(true) }}"></x-inputs.file>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.input-box-right
                        box="dias"
                        label="Alertar kit desatualizado após"
                        name="kit_limite_dias_atualizacao"
                        type="number"
                        step="1"
                        value="{{ $kitLimiteDiasAtualizacao }}"></x-inputs.input-box-right>
                    <small class="text-muted">Kits cuja última atualização de valores for mais antiga que esse limite mostram o aviso em vermelho na lista de kits.</small>
                </div>
            </div>
            <div class="row p-3">
                <button type="submit" class="btn btn-success mx-auto">Salvar</button>
            </div>
        </form>
    </x-body>
</x-layout>
