<x-layout menu="margens" submenu="margem-estado">
    <x-body title="Margem por Estado" class="p-4">
        <form method="POST" action="{{ route('admin.precificacao.estado.store') }}"> @csrf
            <h4>Sudeste</h4>
            <div class="row mb-4 border-bottom">
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="SP" type="number"
                                              name="SP" value="{{ $margens['SP'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="RJ" type="number"
                                              name="RJ" value="{{ $margens['RJ'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="ES" type="number"
                                              name="ES" value="{{ $margens['ES'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="MG" type="number"
                                              name="MG" value="{{ $margens['MG'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
            </div>

            <h4>Sul</h4>
            <div class="row mb-4 border-bottom">
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="PR" type="number"
                                              name="PR" value="{{ $margens['PR'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="RS" type="number"
                                              name="RS" value="{{ $margens['RS'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="SC" type="number"
                                              name="SC" value="{{ $margens['SC'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
            </div>

            <h4>Centro Oeste</h4>
            <div class="row mb-4 border-bottom">
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="MT" type="number"
                                              name="MT" value="{{ $margens['MT'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="MS" type="number"
                                              name="MS" value="{{ $margens['MS'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="GO" type="number"
                                              name="GO" value="{{ $margens['GO'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="DF" type="number"
                                              name="DF" value="{{ $margens['DF'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
            </div>

            <h4>Nordeste</h4>
            <div class="row mb-4 border-bottom">
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="AL" type="number"
                                              name="AL" value="{{ $margens['AL'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="BA" type="number"
                                              name="BA" value="{{ $margens['BA'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="CE" type="number"
                                              name="CE" value="{{ $margens['CE'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="MA" type="number"
                                              name="MA" value="{{ $margens['MA'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="PI" type="number"
                                              name="PI" value="{{ $margens['PI'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="RN" type="number"
                                              name="RN" value="{{ $margens['RN'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="PE" type="number"
                                              name="PE" value="{{ $margens['PE'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="PB" type="number"
                                              name="PB" value="{{ $margens['PB'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="SE" type="number"
                                              name="SE" value="{{ $margens['SE'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
            </div>

            <h4>Sul</h4>
            <div class="row mb-4 border-bottom">
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="AM" type="number"
                                              name="AM" value="{{ $margens['AM'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="RR" type="number"
                                              name="RR" value="{{ $margens['RR'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="AP" type="number"
                                              name="AP" value="{{ $margens['AP'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="PA" type="number"
                                              name="PA" value="{{ $margens['PA'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="RO" type="number"
                                              name="RO" value="{{ $margens['RO'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="AC" type="number"
                                              name="AC" value="{{ $margens['AC'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
                <div class="col-md-2">
                    <x-inputs.input-box-right box="%" label="TO" type="number"
                                              name="TO" value="{{ $margens['TO'] ?? '' }}"
                                              step="0.001"></x-inputs.input-box-right>

                </div>
            </div>
            <div class="row p-4">
                    <button class="btn btn-primary mx-auto">Salvar</button>
            </div>
        </form>
    </x-body>
</x-layout>
