<x-layout menu="usuarios" submenu="vendedores">
    <x-body title="Cadastrar Vendedor" url-button="back">
        <form method="POST" action="{{route('admin.usuarios.vendedores.store')}}"> @csrf
            <div class="form-row">
                <div class="col">
                    <x-inputs.input label="Nome" type="text" name="name" required></x-inputs.input>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <x-inputs.input label="CPF" type="text" name="cpf" id="cpf"></x-inputs.input>
                </div>
                <div class="col">
                    <x-inputs.input label="CNPJ" type="text" name="cnpj" id="cnpj"></x-inputs.input>
                </div>
                <div class="col">
                    <x-inputs.input label="RG" type="text" name="rg" id="rg"></x-inputs.input>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <x-inputs.input label="Email" type="email" name="email" required></x-inputs.input>
                </div>
                <div class="col">
                    <x-inputs.input label="Celular" type="text" name="celular" id="celular"></x-inputs.input>
                </div>
            </div>
            <hr/>
            <div class="form-row">
                <div class="col-6 col-md-3">
                    <x-inputs.input-box-right type="number" step="0.01" box="%" name="taxa_comissao" label="Comissão por Venda" required></x-inputs.input-box-right>
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-control-label d-block pt-2">Permitir Acesso</label>
                    <label class="custom-toggle">
                        <input type="checkbox" name="status" checked>
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
