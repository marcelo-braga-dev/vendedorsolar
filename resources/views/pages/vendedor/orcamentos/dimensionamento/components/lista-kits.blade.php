@foreach ($kits as $item)
    <div class="col-12 card-escolher-kits p-0 mb-4 shadow">
        <div class="card mt-0 border">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-auto mb-2">
                        <small>Potência total dos kit: <b>{{ convert_float_money($item['potencia']) }} kWp</b></small>
                    </div>
                    <div class="col-auto mb-2">
                        <div class="row">
                            <div class="col-6 col-md-auto text-center">
                                <img src="{{ asset('storage') . '/' . $produtos[$item['inversor']]['logo'] }}"
                                     style="max-width:100px"/>
                            </div>
                            <div class="col-6 col-md-auto text-center">
                                <img src="{{ asset('storage') . '/' . $produtos[$item['painel']]['logo'] }}"
                                     style="max-width:100px"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body py-0">
                @foreach ($item['kits'] as $kit)
                    <div class="row py-3 border-bottom">
                        <div class="col-md-9 text-sm mb-3 mb-md-0" style="white-space: normal">
                            @if ($kit['trafo'])
                                <div class="d-block">
                                    <span class="badge badge-warning">Transformador Incluso</span>
                                </div>
                            @endif
                            <p>
                                <b>{{ $item['qtdKits'] }}x {{ $kit['modelo'] }}</b>
                                <small class="text-muted d-block">[ID #{{ $kit['id'] }}]</small>
                            </p>
                            @if(!empty($kit['modelo_trafo']))
                                <p><b>{{ $kit['modelo_trafo'] }}</b></p>
                            @endif
                            <div class="row pt-2">
                                <div class="col-md-6">
                                    <span class="d-block"><b>Potência total do kit:</b> {{ convert_float_money($item['potencia']) }} kWp</span>
                                    <span class="d-block"><b>Geração Estimada: </b> {{ convert_float_money($item['geracao'], 0) }} kWh</span>
                                </div>
                                <div class="col-md-6">
                                        <span class="d-block">
                                            <b>Inversor:</b> {{ $produtos[$item['inversor']]['nome'] }}
                                        </span>
                                    <span>
                                            <b>Painel:</b> {{ $produtos[$item['painel']]['nome'] }} {{$kit['potencia_painel']}} W
                                        </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="pb-2">
                                @if(!empty($kit['preco_trafo']))
                                    <small class="d-block">Kits:
                                        R$ {{ convert_float_money($kit['preco'] - $kit['preco_trafo']) }}</small>
                                    <small class="d-block mb-2">Transformador:
                                        R$ {{ convert_float_money($kit['preco_trafo']) }}</small>
                                @endif
                                <small class="d-block"><b>Total:</b></small>
                                <span class="text-center h2">
                                    <b>R$ {{ convert_float_money($kit['preco']) }}</b>
                                </span>
                            </div>
                            <form method="POST"
                                  action="{{ route('vendedor.dimensionamento.convencional.store') }}"> @csrf
                                <input type="hidden" name="consumo" value="{{$request->consumo ?? 0}}">
                                <input type="hidden" name="consumo_ponta" value="{{$request->consumo_ponta}}">
                                <input type="hidden" name="consumo_fora_ponta" value="{{$request->consumo_fora_ponta}}">
                                <input type="hidden" name="demanda" value="{{$request->demanda}}">
                                <input type="hidden" name="id_kit" value="{{$kit['id']}}">
                                <input type="hidden" name="preco" value="{{$kit['preco']}}">
                                <input type="hidden" name="cidade" value="{{$request->cidade}}">
                                <input type="hidden" name="estrutura" value="{{$request->estrutura}}">
                                <input type="hidden" name="tensao" value="{{$request->tensao}}">
                                <input type="hidden" name="orientacao" value="{{$request->orientacao}}">
                                <input type="hidden" name="cliente" value="{{$request->cliente}}">
                                <input type="hidden" name="geracao" value="{{$item['geracao']}}">
                                <input type="hidden" name="trafo" value="{{$kit['trafo']}}">
                                <input type="hidden" name="qtd_kits" value="{{$item['qtdKits']}}">
                                <button type="submit" class="btn btn-success  btn-block mt-2 criar-orcamento">
                                    Escolher Esse Kit
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endforeach

@empty($kits)
    <div class="col-12 alert alert-info text-center">Não foi encontrado kits para esse dimensionamento.</div>
@endempty
