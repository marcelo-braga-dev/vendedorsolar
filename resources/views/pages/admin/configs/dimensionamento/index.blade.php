<x-layout menu="configs" submenu="dimensionamento">
    <x-body title="Dados para dimensionamento">
        <form method="POST" action="{{ route('admin.configs.dimensionamento.store') }}"> @csrf
            <h4 class="d-block">Cálculo:</h4>
            <div class="row">
                <div class="col-6 col-md-2">
                    <x-inputs.input-box-right box="%" label="Ajuste da Equação" name="margem_perda" type="number"
                                              value="{{ $dados['margem_perda'] }}"
                                              step="0.01"></x-inputs.input-box-right>
                </div>
            </div>
            <hr>
            <h4 class="d-block">Perda por orientação:</h4>
            <div class="row">
                <div class="col-6 col-md-2">
                    <x-inputs.input-box-right box="%" label="Nordeste/Noroeste" name="orientacao_nordeste_noroeste"
                                              type="number" step="0.01"
                                              value="{{ $dados['orientacao_nordeste_noroeste'] }}"
                                             ></x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-2">
                    <x-inputs.input-box-right box="%" label="Leste/Oeste" name="orientacao_leste_oeste" type="number"
                                              value="{{ $dados['orientacao_leste_oeste'] }}" step="0.01"
                                             ></x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-2">
                    <x-inputs.input-box-right box="%" label="Sudeste/Sudoeste" name="orientacao_sudeste_sudoeste"
                                              type="number"
                                              value="{{ $dados['orientacao_sudeste_sudoeste'] }}" step="0.01"
                                             ></x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-2">
                    <x-inputs.input-box-right box="%" label="Sul" name="orientacao_sul" type="number"
                                              value="{{ $dados['orientacao_sul'] }}" step="0.01"
                                             ></x-inputs.input-box-right>
                </div>
            </div>

            <div class="row">
                <div class="col-auto mx-auto py-3">
                    <button class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
