<x-layout menu="dimensionamento" submenu="demanda">
    <x-body title="Gerar Proposta - Sistema com Demanda" url-button="">
        <form action="{{ route('vendedor.dimensionamento.convencional.create') }}" id="form-dimensionamento"> @csrf
            <div class="form-row border-bottom mb-3">
                {{-- Cliente --}}
                <div class="col-md-6">
                    <x-inputs.select label="Cliente" name="cliente" id="cliente">
                        <option value=""></option>
                        @foreach ($clientes as $item)
                            <option value="{{ $item->id }}" localidade="{{ $item->cidades_estados_id }}">
                                {{ getNomeCliente($item->id) }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                {{-- Estado --}}
                <div class="col-6 col-md-3">
                    <x-inputs.select label="Estado" name="estado" id="estado">
                        <option value=""></option>
                        @foreach (getEstados() as $estado)
                            <option value="{{ $estado->sigla }}">{{ $estado->estado }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.select label="Cidade" name="cidade" id="cidade">
                    </x-inputs.select>
                </div>
            </div>

            <div class="form-row border-bottom mb-3">
                <div class="col-6 col-md-3">
                    <x-inputs.select label="Estrutura" name="estrutura" id="estrutura">
                        <option></option>
                        @foreach (getEstruturas() as $item)
                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.select label="Tensão" name="tensao" id="tensao">
                        <option></option>
                        <optgroup label="220V">
                            <option value="220">220V / Bifásico</option>
                            <option value="220">220V / Trifásico</option>
                        </optgroup>
                        <optgroup label="380V">
                            <option value="380">380V / Bifásico</option>
                            <option value="380">380V / Trifásico</option>
                        </optgroup>
                    </x-inputs.select>
                </div>
                <div class="col-12 col-md-3">
                    <x-inputs.select label="Orientação da Instalação" name="orientacao" id="orientacao">
                        <option></option>
                        @foreach($orientacoes as $key => $orientacao)
                            <option value="{{ $key }}">{{ $orientacao }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-12 col-md-3">
                    <x-inputs.select label="Concessionária" name="concessionaria" id="concessionaria">
                        <option></option>
                        @foreach ($concessionarias as $item)
                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
            </div>

            <div class="form-row border-bottom mb-3">
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Consumo Fora de Ponta" box="kWh"
                                              type="number" name="consumo_fora_ponta"
                                              id="consumo_fora_ponta" value=""></x-inputs.input-box-right>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Consumo na Ponta" box="kWh"
                                              type="number" name="consumo_ponta" id="consumo_ponta"
                                              value=""></x-inputs.input-box-right>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Demanda Contratada" box="kW"
                                              type="number" name="demanda" id="demanda"
                                              value=""></x-inputs.input-box-right>
                </div>
            </div>

            <button type="button" class="btn btn-link" id="mais-config">Mais configurações</button>

            <div class="form-row mais-config d-none">
                <div class="col-auto align-self-center"><p>Qtd. de kits no sistema:</p></div>
                <div class="col-auto col-md-1">
                    <x-inputs.input label=""
                                    type="number" name="qtd_kits" id="qtd_kits" value="1"></x-inputs.input>
                </div>
            </div>
            <div class="form-row mais-config d-none border-bottom mb-3">
                <div class="col-auto align-self-center"><p>Verificar necessidade de trafo?</p></div>
                <div class="col-auto">
                    <label class="custom-toggle ml-4">
                        <input type="checkbox" id="trafo" checked>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="Não"
                              data-label-on="Sim"></span>
                    </label>
                </div>
            </div>

            <div class="row px-6" id="alert" style="display: none">
                <div class="alert alert-danger col-12 text-center">Preencha todos os campos.</div>
            </div>

            <div class="row justify-content-center my-4">
                <div class="col-md-6 text-center">
                    <button type="button" id="pesquisar-kits" class="btn btn-primary">
                        Pesquisar Kits
                    </button>
                </div>
            </div>
        </form>

        <div class="row justify-content-center mb-4" id="refazer-calculo" style="display: none">
            <div class="col-md-6 text-center">
                <button type="button" class="btn btn-primary" id="refazer-calculo">Refazer Dimensionamento</button>
            </div>
        </div>

        <div class="row" id="kits"></div>
    </x-body>
    @push('js')
        <script>
            $(function () {
                $('#mais-config').click(function () {
                    $('.mais-config').toggleClass('d-none');
                });
            })
        </script>
        <script>
            $(function () {
                $('#cliente').change(function () {
                    let estadoCliente = $('#cliente option:selected').attr('localidade');

                    $.get(
                        "{{ route('api.endereco.id.cidade.estado' ) }}", {
                            'id': estadoCliente
                        }, function (result) {
                            preencheEstado(result.sigla);
                            preencheCidade(result.sigla, result.cidade);
                        });
                });
            })
        </script>
        <script>
            $(function () {
                $('#pesquisar-kits').click(function () {
                    $.get(
                        "{{ route('vendedor.dimensionamento.demanda.kits') }}", {
                            'cidade': $('#cidade').val(),
                            'estrutura': $('#estrutura').val(),
                            'tensao': $('#tensao').val(),
                            'orientacao': $('#orientacao').val(),
                            'consumo_fora_ponta': $('#consumo_fora_ponta').val(),
                            'consumo_ponta': $('#consumo_ponta').val(),
                            'demanda': $('#demanda').val(),
                            'cliente': $('#cliente').val(),
                            'concessionaria': $('#concessionaria').val(),
                            'qtd_kits': $('#qtd_kits').val(),
                            'verificar_trafo': $('#trafo').is(':checked')
                        }, function (result) {
                            $('#alert').hide();
                            $('#form-dimensionamento').toggle();
                            $('#kits').children().remove();
                        }
                    ).done(function (result) {
                            $('#kits').append(result);
                            $('#refazer-calculo').toggle();
                        }
                    ).fail(function () {
                            $('#alert').show();
                            $('#kits').children().remove();
                        }
                    ).always(function () {

                        }
                    );
                });

                $('#refazer-calculo').click(function () {
                    $('#refazer-calculo').toggle();
                    $('#form-dimensionamento').toggle();
                    $('#kits').children().remove();
                });
            })
        </script>
        <script src="{{ asset('assets') }}/js/select-cidades-estados.js"></script>
    @endpush
</x-layout>
