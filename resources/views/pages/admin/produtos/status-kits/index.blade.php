<x-layout menu="kits_fv" submenu="kits_fv_status">
    <x-body title="Alterar Status dos Kits do Fornecedor">
        <div class="card mb-3">
            <div class="card-body">
                <h3>Fonecedores</h3>
                <input type="hidden" id="fornecedor" value="{{ $fornecedor }}">
                @foreach($fornecedores as $item)
                    <a class="btn mb-3 @if($item->id == $fornecedor)btn-primary @else btn-secondary  @endif"
                       href="{{ route('admin.produtos.status-kits.index', ['id' => $item->id]) }}">
                        {{ $item->nome }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5 border-right">
                        <div class="nav-wrapper pt-0">
                            <h3>Marca dos Inversores</h3>
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row"
                                id="tabs-icons-text" role="tablist">
                                @foreach($kits as $index => $inversores)
                                    <li class="nav-item d-block">
                                        <a class="nav-link mb-3 @if ($loop->first) active @endif"
                                           id="tabs-icons-text-{{ $index }}-tab"
                                           data-toggle="tab" role="tab" aria-selected="true"
                                           href="#tabs-icons-text-{{ $index }}"
                                           aria-controls="tabs-icons-text-{{ $index }}">
                                            {{$marcas[$index]['nome']}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="tab-content" id="myTabContent">
                            @foreach($kits as $indexInversor => $inversores)
                                <div class="tab-pane fade @if ($loop->first) show active @endif"
                                     id="tabs-icons-text-{{ $indexInversor }}" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Marca dos Painéis</h3>
                                            <div class="nav flex-column nav-pills"
                                                 id="v-pills-tab-{{ $indexInversor }}" role="tablist"
                                                 aria-orientation="vertical">
                                                @foreach($inversores as $indexPaineis => $paineis)
                                                    <a class="nav-link @if ($loop->first) active @endif mb-2"
                                                       id="v-pills-home-tab-{{ $indexInversor }}-{{$indexPaineis}}"
                                                       data-toggle="pill"
                                                       href="#v-pills-home-{{ $indexInversor }}-{{$indexPaineis}}"
                                                       role="tab"
                                                       aria-controls="v-pills-home-{{ $indexInversor }}-{{$indexPaineis}}"
                                                       aria-selected="true">
                                                        {{$marcas[$indexPaineis]['nome']}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tab-content"
                                                 id="v-pills-tabContent-{{ $indexInversor }}">
                                                @foreach($inversores as $indexPaineis => $paineis)
                                                    <div
                                                        class="tab-pane fade @if ($loop->first) show active @endif"
                                                        id="v-pills-home-{{ $indexInversor }}-{{$indexPaineis}}"
                                                        role="tabpanel"
                                                        aria-labelledby="v-pills-home-tab-{{ $indexInversor }}-{{$indexPaineis}}">
                                                        <div class="row justify-content-between">
                                                            <div class="col-auto">
                                                                <h3>Potência dos Painéis</h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <small class="d-block">Fornecedor: </small>
                                                                <span class="d-block mb-2">{{ $nomeFornecedor }}</span>
                                                                <div class="row border-bottom mb-2 pb-2">
                                                                    <div class="col-6 text-center">
                                                                        <img class="px-1"
                                                                             src="{{ asset('storage') . '/' . $marcas[$indexInversor]['logo'] }}"
                                                                             width="80">
                                                                        <small class="d-block">Inversor</small>
                                                                    </div>
                                                                    <div class="col-6 text-center">
                                                                        <img class="px-1"
                                                                             src="{{ asset('storage') . '/' . $marcas[$indexPaineis]['logo'] }}"
                                                                             width="80">
                                                                        <small class="d-block">Painel</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @foreach($paineis as $painel)
                                                                <div class="col-12 border-bottom border-left">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-auto align-self-center">
                                                                            {{ $painel->potencia_painel }} W
                                                                        </div>
                                                                        <div class="col-auto">
                                                                            <small class="d-block pl-1 text-muted">status</small>
                                                                            <label class="custom-toggle">
                                                                                <input type="checkbox"
                                                                                       class="mudar-status"
                                                                                       inversor="{{ $indexInversor }}"
                                                                                       painel="{{$indexPaineis}}"
                                                                                       potencia="{{ $painel->potencia_painel }}"
                                                                                       @if ($painel->status) checked @endif>
                                                                                <span
                                                                                    class="custom-toggle-slider rounded-circle"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-body>

    @push('js')
        <script>
            $(function () {
                $('.mudar-status').change(function () {
                    const fornecedor = $('#fornecedor').val();
                    const inversor = $(this).attr('inversor');
                    const painel = $(this).attr('painel');
                    const potencia = $(this).attr('potencia');
                    const status = $(this).is(':checked');

                    $.ajax({
                        url: "{{ route('api.fornecedores.alterar-status-kits') }}",
                        method: "GET",
                        dataType: "HTML",
                        data: {
                            'fornecedor': fornecedor,
                            'inversor': inversor,
                            'painel': painel,
                            'potencia': potencia,
                            "status": status
                        }
                    }).done(function (data) {
                        // console.log(data)
                    });
                });
            });
        </script>
    @endpush
</x-layout>





