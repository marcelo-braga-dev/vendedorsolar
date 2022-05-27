<x-layout menu="usuarios" submenu="admins">
    <x-body title="Cadastrar Administrador" url-button="back">
        <form method="POST" action="{{route('admin.usuarios.admins.store')}}"> @csrf
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Nome" type="text" name="name" required></x-inputs.input>
                </div>
            </div>
            <div class="row">
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
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Email" type="email" name="email" required></x-inputs.input>
                </div>
                <div class="col">
                    <x-inputs.input label="Celular" type="text" name="celular" id="celular"></x-inputs.input>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
