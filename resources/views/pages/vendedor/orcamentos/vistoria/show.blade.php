<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <x-body title="Imagens do Local da Instalação" url-button="{{ route('vendedor.orcamento.show', $id) }}">
        @if ($disabled)
            <div class="alert alert-info">
                <span class="d-block"><b>Não é possível editar orçamentos enviados para aprovação.</b></span>
                <span class="d-block">Se necessário, solicite a um administrador permissão para editar.</span>
                <span>ID do orçamento: #{{ $id }}</span>
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data"
              action="{{ route('vendedor.orcamento.vistoria.store', $id) }}"> @csrf
            <div class="row justify-content-around">
                <div class="col-md-4 mb-6 text-center">
                    <x-inputs.file name="disjuntor" label="Disjuntor"
                                   url="{{ $vistoria->slug_disjuntor ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <x-inputs.file name="padrao_energia" label="Padrão de Energia"
                                   url="{{ $vistoria->slug_padrao_energia ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <x-inputs.file name="telhado" label="Telhado"
                                   url="{{$vistoria->slug_telhado ?? '' }}"></x-inputs.file>
                </div>
            </div>
            <div class="row justify-content-around">
                <div class="col-md-4 mb-6 text-center">
                    <x-inputs.file name="fiacao" label="Fiação" url="{{$vistoria->slug_fiacao ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <x-inputs.file name="medidor" label="Medidor"
                                   url="{{ $vistoria->slug_medidor ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4 mb-6 text-center">
                    <x-inputs.file name="outros" label="Outros" url="{{$vistoria->slug_outros ?? '' }}"></x-inputs.file>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.file label="Vídeo 1" name="arquivo_1"
                                   url="{{ $vistoria->slug_arquivo_1 ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4">
                    <x-inputs.file label="Vídeo 2" name="arquivo_2"
                                   url="{{ $vistoria->slug_arquivo_2 ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4">
                    <x-inputs.file label="Vídeo 3" name="arquivo_3"
                                   url="{{ $vistoria->slug_arquivo_3 ?? '' }}"></x-inputs.file>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <x-inputs.textarea rows="6" label="Observaçãoes"
                                       name="observacoes">{{ $vistoria->observacoes ?? '' }}</x-inputs.textarea>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-auto mx-auto">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button class="btn btn-primary" id="btn-submit">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
    @push('js')
        <script>
            $(function () {
                if ({{ $disabled }}) {
                    $('input, #btn-submit').attr('disabled', 'true');
                }
            })
        </script>
    @endpush
</x-layout>
