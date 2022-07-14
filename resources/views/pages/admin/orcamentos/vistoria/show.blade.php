<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Imagens do Local da Instalação" url-button="{{ route('admin.orcamentos.show', $id) }}">
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('admin.orcamento.vistoria.store', $id) }}"> @csrf
            <div class="row justify-content-around">
                <div class="col-md-4 mb-6 text-center">
                    <div class="border rounded p-2">
                        <label class="form-control-label d-block">Disjuntor</label>
                        @if ($vistoria->slug_disjuntor ?? '')
                            <img src="{{ asset('storage')}}/{{ $vistoria->slug_disjuntor }}" width="100" alt="">
                            <a href="{{ asset('storage')}}/{{ $vistoria->slug_disjuntor }}"
                               class="btn btn-link d-block" download>Download</a>
                        @endif
                        <input type="file" name="disjuntor" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <div class="border rounded p-2">
                        <label class="form-control-label d-block">Padrão de Energia</label>
                        @if ($vistoria->slug_padrao_energia ?? '')
                            <img src="{{ asset('storage/')}}/{{ $vistoria->slug_padrao_energia ?? '' }}" width="100"
                                 alt="">
                            <a href="{{ asset('storage')}}/{{ $vistoria->slug_padrao_energia }}"
                               class="btn btn-link d-block" download>Download</a>
                        @endif
                        <input type="file" name="padrao_energia" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <div class="border rounded p-2">
                        <label class="form-control-label d-block">Telhado</label>
                        @if ($vistoria->slug_telhado ?? '')
                            <img src="{{ asset('storage/')}}/{{$vistoria->slug_telhado ?? '' }}" width="100" alt="">
                            <a href="{{ asset('storage')}}/{{ $vistoria->slug_telhado }}"
                               class="btn btn-link d-block" download>Download</a>
                        @endif
                        <input type="file" name="telhado" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-4 mb-6 text-center">
                    <div class="border rounded p-2">
                        <label class="form-control-label d-block">Fiação</label>
                        @if ($vistoria->slug_fiacao ?? '')
                            <img src="{{ asset('storage/')}}/{{$vistoria->slug_fiacao ?? '' }}" width="100" alt="">
                            <a href="{{ asset('storage')}}/{{ $vistoria->slug_telhado }}"
                               class="btn btn-link d-block" download>Download</a>
                        @endif
                        <input type="file" name="fiacao" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <div class="border rounded p-2">
                        <label class="form-control-label d-block">Medidor</label>
                        @if ($vistoria->slug_medidor ?? '')
                            <img src="{{ asset('storage/')}}/{{ $vistoria->slug_medidor ?? '' }}" width="100" alt="">
                            <a href="{{ asset('storage')}}/{{ $vistoria->slug_telhado }}"
                               class="btn btn-link d-block" download>Download</a>
                        @endif
                        <input type="file" name="medidor" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <div class="border rounded p-2">
                        <label class="form-control-label d-block">Outros</label>
                        @if ($vistoria->slug_outros ?? '')
                            <img src="{{ asset('storage/')}}/{{$vistoria->slug_outros ?? '' }}" width="100" alt="">
                            <a href="{{ asset('storage')}}/{{ $vistoria->slug_telhado }}"
                               class="btn btn-link d-block" download>Download</a>
                        @endif
                        <input type="file" name="outros" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <x-inputs.textarea rows="6" label="Observaçãoes"
                                       name="observacoes">{{ $vistoria->observacoes ?? '' }}</x-inputs.textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-auto mx-auto">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
