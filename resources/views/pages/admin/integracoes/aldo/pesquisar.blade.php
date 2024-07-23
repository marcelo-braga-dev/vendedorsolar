<x-layout menu="integracoes" submenu="aldo">
    <x-body title="Integracão Aldo - Atualizar Campos">
        <form method="POST" action="{{ route('admin.integracoes.aldo.store') }}">
            @csrf @method('put')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card card-body shadow">
                        <h3>Inversores</h3>
                        @foreach($dados['inversores'] as $index => $item)
                            <div class="border-bottom mb-2">
                                <x-inputs.select label="{{ $index }}" name="inversores[{{$index}}]" required>
                                    <option value=""></option>
                                    @foreach($produtos['inversor'] as $id => $produto)
                                        <option value="{{ $id }}"
                                                @if ($item == $id) selected @endif>
                                            {{ $produto }}
                                        </option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card card-body shadow">
                        <h3>Painéis</h3>
                        @foreach($dados['painel'] as $index => $item)
                            <label class="form-control-label">{{ $index }}</label>
                            <div class="form-row">
                                <div class="col-6 col-md-8">
                                    <x-inputs.select label="" name="paineis[{{ $index }}]" required>
                                        <option value=""></option>
                                        @foreach($produtos['painel'] as $id => $produto)
                                            <option value="{{ $id }}"
                                                    @if ($item['id_referencia'] == $id) selected @endif>{{ $produto }}</option>
                                        @endforeach
                                    </x-inputs.select>
                                </div>
                                <div class="col-6 col-md-4">
                                    <x-inputs.input-box-right box="W" type="number"
                                                              name="potencia_paineis[{{ $index }}]"
                                                              label="" value="{{ $item['potencia'] }}" required>
                                    </x-inputs.input-box-right>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card card-body shadow">
                        <h3>Transformadores</h3>
                        @foreach($dados['trafos'] as $index => $item)
                            <div class="border-bottom mb-2">
                                <x-inputs.select label="{{ $index }}" name="trafos[{{$index}}]" required>
                                    <option value=""></option>
                                    @foreach($produtos['trafo'] as $id => $produto)
                                        <option value="{{ $id }}"
                                                @if ($item == $id) selected @endif>
                                            {{ $produto }}
                                        </option>
                                    @endforeach
                                </x-inputs.select>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card card-body shadow">
                        <h3>Estruturas</h3>
                        @foreach($dados['estruturas'] as $index => $item)
                            <x-inputs.select label="{{ $index }}" name="estruturas[{{ $index }}]">
                                @foreach(getEstruturas() as $estrutura)
                                    <option value="{{ $estrutura->id }}"
                                            @if ($item == $estrutura->id) selected @endif>{{ $estrutura->nome }}</option>
                                @endforeach
                            </x-inputs.select>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row justify-content-center py-4">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
