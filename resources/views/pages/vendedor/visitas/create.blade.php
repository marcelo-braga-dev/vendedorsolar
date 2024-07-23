<x-layout menu="visita" submenu="agendadas">
    <x-body title="Agendar Visita" url-button="">
        <form method="POST" action="{{ route('vendedor.visitas.store') }}"> @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <x-inputs.select name="cliente" label="Cliente" required>
                        <option></option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ getNomeCliente($cliente->id) }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-6 col-md-3">
                    <x-inputs.date-time label="Data/Hora" name="data" required></x-inputs.date-time>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <x-inputs.textarea label="Anotações" name="anotacoes"></x-inputs.textarea>
                </div>
                </div>
            <div class="row m-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Agendar Visita</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
