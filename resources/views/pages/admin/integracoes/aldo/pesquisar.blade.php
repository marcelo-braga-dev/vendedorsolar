<x-layout menu="integracoes" submenu="aldo">
    <x-body title="Integracão Aldo - Pesquisar">
        {{-- Inversores --}}
        <form method="POST" action="{{ route('admin.integracoes.aldo.store') }}">
            @csrf @method('put')
            <div class="row">
                <div class="col">
                    <x-tables.table-default>
                        <x-slot name="head">
                            <tr>
                                <th>Inversores</th>
                                <th>Campo</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($dados['inversores'] as $index => $item)
                                <tr>
                                    <td style="white-space: normal">{{ $index }}</td>
                                    <td>
                                        <x-inputs.select label="" name="inversores[{{$index}}]" required>
                                            <option value=""></option>
                                            @foreach($produtos['inversor'] as $id => $produto)
                                                <option value="{{ $id }}"
                                                        @if ($item == $id) selected @endif>{{ $produto }}</option>
                                            @endforeach
                                        </x-inputs.select>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-tables.table-default>
                </div>
            </div>

            {{-- Paineis --}}
            <hr>
            <div class="row">
                <div class="col">
                    <x-tables.table-default>
                        <x-slot name="head">
                            <tr>
                                <th>Painéis</th>
                                <th>Campo</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($dados['painel'] as $index => $item)
                                <tr>
                                    <td style="white-space: normal">{{ $index }}</td>
                                    <td>
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
                                                <x-inputs.input-box-right box="W" type="number" name="potencia_paineis[{{ $index }}]"
                                                                          label=""
                                                                          value="{{ $item['potencia'] }}" required>
                                                </x-inputs.input-box-right>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-tables.table-default>
                </div>
            </div>

            {{-- Estruturas --}}
            <div class="row">
                <div class="col">
                    <x-tables.table-default>
                        <x-slot name="head">
                            <tr>
                                <th>Estruturas</th>
                                <th>Campo</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($dados['estruturas'] as $index => $item)
                                <tr>
                                    <td style="white-space: normal">{{ $index }}</td>
                                    <td>
                                        <x-inputs.select label="" name="estruturas[{{ $index }}]">
                                            @foreach(get_estruturas() as $estrutura)
                                                <option value="{{ $estrutura->id }}"
                                                        @if ($item == $estrutura->id) selected @endif>{{ $estrutura->nome }}</option>
                                            @endforeach
                                        </x-inputs.select>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-tables.table-default>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
