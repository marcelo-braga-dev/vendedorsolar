<x-layout menu="configs" submenu="dimensionamento">
    <x-body title="Sistema">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.configs.sistema.store') }}"> @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.file label="Logo" name="logo" url="{{ getLogoPrincipal(true) }}"></x-inputs.file>
                </div>
            </div>
            <div class="row p-3">
                <button type="submit" class="btn btn-success mx-auto">Salvar</button>
            </div>
        </form>
    </x-body>
</x-layout>
