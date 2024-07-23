<x-layout menu="orcamentos" submenu="todos_orcamentos">
    <form method="POST" enctype="multipart/form-data"
          action="{{ route('vendedor.orcamento.aprovacao.store', ['id' => $id]) }}"> @csrf
        <x-body title="Informações do Cliente do Financiamento"
                url-button="{{ route('vendedor.orcamento.show', $id) }}">
            @if ($disabled)
                <div class="alert alert-info">
                    <span class="d-block"><b>Não é possível editar orçamentos enviados para aprovação.</b></span>
                    <span class="d-block">Se necessário, solicite a um administrador permissão para editar.</span>
                    <span>ID do orçamento: #{{ $id }}</span>
                </div>
            @endif
            <h5>Pessoa Física</h5>
            <div class="form-row mb-4">
                <div class="col-md-6">
                    <x-inputs.input label="Nome" type="text" name="nome_financiador"
                                    value="{{ $dados['nome_financiador'] ?? $cliente->nome }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="CPF" type="text" name="cpf_financiador" class="mask-cpf"
                                    value="{{ $dados['cpf_financiador'] ?? $clienteMetas['cpf'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="RG" type="text" name="rg_financiador" class="mask-rg"
                                    value="{{ $dados['rg_financiador'] ?? $clienteMetas['rg'] ?? '' }}"></x-inputs.input>
                </div>
            </div>

            <h5>Pessoa Jurídica</h5>
            <div class="form-row mb-4">
                <div class="col-md-3">
                    <x-inputs.input label="CNPJ" type="text" name="cnpj_financiador" class="mask-cnpj"
                                    value="{{ $dados['cnpj_financiador'] ?? $clienteMetas['cnpj'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Razão Social" type="" name="razao_social_financiador"
                                    value="{{ $dados['razao_social_financiador'] ?? $cliente->razao_social }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Nome Fantasia" type="" name="nome_fantasia_financiador"
                                    value="{{ $dados['nome_fantasia_financiador'] ?? $clienteMetas['nome_fantasia'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Inscrição Estadual" type="" name="inscricao_financiador"
                                    value="{{ $dados['inscricao_financiador'] ?? $clienteMetas['inscricao_social'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <hr>
            <h5>Endereço</h5>
            <div class="form-row">
                <div class="col-6 col-md-3">
                    <x-inputs.input label="Cep" type="" name="cep_financiador" required
                                    value="{{ $dados['cep_financiador'] ?? $clienteMetas['cep'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-9">
                    <x-inputs.input label="Rua/Av" type="" name="rua_financiador" required
                                    value="{{ $dados['rua_financiador'] ?? $clienteMetas['endereco'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2">
                    <x-inputs.input label="Número" type="" name="numero_financiador" required
                                    value="{{ $dados['numero_financiador'] ?? $clienteMetas['numero'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Bairro" type="" name="bairro_financiador" required
                                    value="{{ $dados['bairro_financiador'] ?? $clienteMetas['bairro'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Cidade" type="" name="cidade_financiador"
                                    value="{{ $dados['cidade_financiador'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Estado" type="" name="estado_financiador"
                                    value="{{ $dados['estado_financiador'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <hr>
            <h5>Contato</h5>
            <div class="form-row">
                <div class="col-md-6">
                    <x-inputs.input label="Email" type="" name="email_financiador"
                                    value="{{ $dados['email_financiador'] ?? $clienteMetas['email'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Celular" type="" name="celular_financiador"
                                    value="{{ $dados['celular_financiador'] ?? $clienteMetas['celular'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Telefone" type="" name="telefone_financiador"
                                    value="{{ $dados['telefone_financiador'] ?? $clienteMetas['telefone'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
        </x-body>

        <x-body.card title="Informações do Proprietário do Imóvel">
            <h5>Pessoa Física</h5>
            <div class="form-row mb-4">
                <div class="col-md-6">
                    <x-inputs.input label="Nome" type="" name="nome_proprietario"
                                    value="{{ $dados['nome_proprietario'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="CPF" type="" name="cpf_proprietario"
                                    value="{{ $dados['cpf_proprietario'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="RG" type="" name="rg_proprietario"
                                    value="{{ $dados['rg_proprietario'] ?? '' }}"></x-inputs.input>
                </div>
            </div>

            <h5>Pessoa Jurídica</h5>
            <div class="form-row mb-4">
                <div class="col-md-3">
                    <x-inputs.input label="CNPJ" type="" name="cnpj_proprietario"
                                    value="{{ $dados['cnpj_proprietario'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Razão Social" type="" name="razao_social_proprietario"
                                    value="{{ $dados['razao_social_proprietario'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Nome Fantasia" type="" name="nome_fantasia_proprietario"
                                    value="{{ $dados['nome_fantasia_proprietario'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Inscrição Estadual" type="" name="inscricao_estadual_proprietario"
                                    value="{{ $dados['inscricao_estadual_proprietario'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <hr>
            <h5>Documentos Pessoais</h5>
            <div class="form-row">
                <div class="col-md-4">
                    <x-inputs.file label="CNH" name="img_cnh_proprietario"
                                   url="{{ $dados['img_cnh_proprietario'] ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4">
                    <x-inputs.file label="CPF" name="img_cpf_proprietario"
                                   url="{{ $dados['img_cpf_proprietario'] ?? '' }}"></x-inputs.file>
                </div>
                <div class="col-md-4">
                    <x-inputs.file label="RG" name="img_rg_proprietario"
                                   url="{{ $dados['img_rg_proprietario'] ?? '' }}"></x-inputs.file>
                </div>
            </div>
        </x-body.card>

        <x-body.card title="Endereço da Instalação (Onde o material será entregue)">
            <h5>Informação da concessionária</h5>
            <div class="form-row">
                <div class="col-md-5">
                    <x-inputs.input label="Número do Registro na Concessionária" type="text" required
                                    name="registro_instalacao"
                                    value="{{ $dados['registro_instalacao'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-5">
                    <x-inputs.file label="Conta de energia do imóvel da instalação" required
                                   name="img_conta_instalacao"
                                   url="{{ $dados['img_conta_instalacao'] ?? '' }}"></x-inputs.file>
                </div>
            </div>
            <hr>
            <h5>Endereço</h5>
            <div class="form-row">
                <div class="col-6 col-md-3">
                    <x-inputs.input label="Cep" type="" name="cep_instalacao" required
                                    value="{{ $dados['cep_instalacao'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-9">
                    <x-inputs.input label="Rua/Av" type="" name="rua_instalacao" required
                                    value="{{ $dados['rua_instalacao'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2">
                    <x-inputs.input label="Número" type="" name="numero_instalacao" required
                                    value="{{ $dados['numero_instalacao'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-4">
                    <x-inputs.input label="Bairro" type="" name="bairro_instalacao" required
                                    value="{{ $dados['bairro_instalacao'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Cidade" type="" name="cidade_instalacao"
                                    value="{{ $dados['cidade_instalacao'] ?? '' }}"></x-inputs.input>
                </div>
                <div class="col-md-3">
                    <x-inputs.input label="Estado" type="" name="estado_instalacao"
                                    value="{{ $dados['estado_instalacao'] ?? '' }}"></x-inputs.input>
                </div>
            </div>
        </x-body.card>
        <x-body.card>
            <div class="row mb-3">
                <small class="mx-auto">
                    Após enviado, não será possível editar as informações e as fotos da vistoria sem a autorização de um administrador.
                </small>
            </div>
            <div class="form-row">
                <div class="col-auto mx-auto">
                    <button class="btn btn-primary" id="btn-submit">Enviar para Aprovação</button>
                </div>
            </div>
        </x-body.card>
    </form>
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
