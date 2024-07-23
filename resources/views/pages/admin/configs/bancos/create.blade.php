<x-layout menu="financeiro" submenu="bancos">
    <x-body title="Bancos" url-button="{{ route('admin.configs.bancos.index') }}">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.configs.bancos.store') }}"> @csrf
            <div class="row">
                <div class="col-12">
                    <x-inputs.input label="Nome do Banco" name="nome" type="text" required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-md-3">
                    <x-inputs.input label="Qtd. Parcelas" name="qtd_parcelas" type="number" required></x-inputs.input>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.input-box-right box="%" label="Juros Mensal" name="juros_mensal"
                                              type="number" step="0.001" required></x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.input-box-right box="meses" label="Carência" name="carencia"
                                              type="number" required></x-inputs.input-box-right>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-control-label">Logo</label>
                    <input type="file" name="img_logo" class="form-control">
                </div>
            </div>
            <div class="row justify-content-between pt-3">
                <div class="col-4 mx-auto mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
