<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Imagens do Local da Instalação" url-button="{{ route('vendedor.orcamento.show', $id) }}">
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('vendedor.orcamento.vistoria.store', $id) }}"> @csrf
            <div class="row justify-content-around">
                <div class="col-md-4 mb-4">
                    <label class="form-control-label d-block">Disjuntor</label>
                    <img src="{{ asset('storage')}}/{{ $vistoria->slug_disjuntor ?? ''}}" width="100" alt="">
                    <input type="file" name="disjuntor" class="form-control">
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-control-label d-block">Padrão de Energia</label>
                    <img src="{{ asset('storage/')}}/{{ $vistoria->slug_padrao_energia ?? '' }}" width="100" alt="">
                    <input type="file" name="padrao_energia" class="form-control">
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-control-label d-block">Telhado</label>
                    <img src="{{ asset('storage/')}}/{{$vistoria->slug_telhado ?? '' }}" width="100" alt="">
                    <input type="file" name="telhado" class="form-control">
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-4 mb-4">
                    <label class="form-control-label d-block">Fiação</label>
                    <img src="{{ asset('storage/')}}/{{$vistoria->slug_fiacao ?? '' }}" width="100" alt="">
                    <input type="file" name="fiacao" class="form-control">
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-control-label d-block">Medidor</label>
                    <img src="{{ asset('storage/')}}/{{ $vistoria->slug_medidor ?? '' }}" width="100" alt="">
                    <input type="file" name="medidor" class="form-control">
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-control-label d-block">Outros</label>
                    <img src="{{ asset('storage/')}}/{{$vistoria->slug_outros ?? '' }}" width="100" alt="">
                    <input type="file" name="outros" class="form-control">
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
