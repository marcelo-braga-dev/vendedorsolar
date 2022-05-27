<x-layout menu="dimensionamento" submenu="convencional">
    <x-body title="Gerar Proposta - Sistema Convencional" url-button="">
        <form action="{{ route('vendedor.dimensionamento.convencional.create') }}" id="form-dimensionamento"> @csrf
            <div class="row border-bottom mb-3">
                {{-- Cliente --}}
                <div class="col-md-6">
                    <x-inputs.select label="Cliente" name="cliente" id="cliente">
                        <option value=""></option>
                        @foreach ($clientes as $item)
                            <option value="{{ $item->id }}" localidade="{{ $item->cidades_estados_id }}">
                                {{ $item->nome }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                {{-- Estado --}}
                <div class="col-6 col-md-3">
                    <x-inputs.select label="Estado" name="estado" id="estado">
                        <option value=""></option>
                        @foreach (get_estados() as $estado)
                            <option value="{{ $estado->sigla }}">{{ $estado->estado }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.select label="Cidade" name="cidade" id="cidade">
                    </x-inputs.select>
                </div>
            </div>

            <div class="row border-bottom mb-3">
                <div class="col-6 col-md-3">
                    <x-inputs.select label="Estrutura" name="estrutura" id="estrutura">
                        <option></option>
                        @foreach (get_estruturas() as $item)
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
                        <option value="desconsiderar">Desconsiderar</option>
                        <option value="norte">Norte</option>
                        @foreach($orientacoes as $orientacao)
                            <option value="{{ $orientacao->meta_key }}">{{ $orientacao->name }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-3">
                    <x-inputs.input-box-right label="Média Consumo Mensal" box="kWh/mês" type="number" name="consumo"
                                              id="consumo" value=""/>
                </div>
                <div class="col-6 col-md-3">

                </div>
            </div>

            <div class="row px-6" id="alert" style="display: none">
                <div class="alert alert-danger col-12 text-center">Preencha todos os campos.</div>
            </div>

            <div class="row justify-content-center mb-4">
                <div class="col-md-6 text-center">
                    <button type="button" id="pesquisar-kits" class="btn btn-primary">Pesquisar Kits</button>
                </div>
            </div>
        </form>

        <div class="row justify-content-center mb-4" id="refazer-calculo" style="display: none">
            <div class="col-md-6 text-center">
                <button type="button" class="btn btn-primary" id="refazer-calculo">Refazer Dimensionamento</button>
            </div>
        </div>

        <div class="row" id="kits"></div>

        @push('js')
            <script>
                $(function () {
                    $('#cliente').change(function () {
                        let estadoCliente = $('#cliente option:selected').attr('localidade');

                        $.get(
                            "{{ route('api.endereco.id.cidade.estado' ) }}", {
                                'id': estadoCliente
                            }, function (result) {
                                $('#estado').val(result.sigla).select2();
                                preencheCidade(result.sigla, result.cidade);
                            });
                    });
                })
            </script>
            <script>
                $(function () {
                    $('#pesquisar-kits').click(function () {
                        $.get(
                            "{{ route('vendedor.dimensionamento.convencional.kits') }}", {
                                'cidade': $('#cidade').val(),
                                'estrutura': $('#estrutura').val(),
                                'tensao': $('#tensao').val(),
                                'orientacao': $('#orientacao').val(),
                                'consumo': $('#consumo').val(),
                                'cliente': $('#cliente').val(),
                                'verificar_trafo': true
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

            <script> const urlBd = "{{route('cidades-estados')}}"; </script>
            <script src="{{ asset('assets') }}/js/select-cidades-estados.js"></script>
        @endpush

    </x-body>
</x-layout>
