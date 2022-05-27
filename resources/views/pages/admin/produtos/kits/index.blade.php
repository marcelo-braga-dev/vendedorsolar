<x-layout menu="kits_fv" submenu="kits_fv_cadastrados">
    <x-body title="Kits Fotovoltaicos Cadastrados" class="p-0">
        <div class="py-3 mb-4">
            <form class="px-3 ">
                <div class="row">
                    {{-- Id Kit --}}
                    <div class="col-6 col-md-2">
                        <x-inputs.input label="ID do Kit" name="id" type="number"
                                        value="{{ $request->id }}" placeholder="#000"></x-inputs.input>
                    </div>
                    {{-- Estruturas --}}
                    <div class="col-6 col-md-4">
                        <x-inputs.select name="estrutura" label="Estrutura">
                            <option value="">Todos</option>
                            @foreach(get_estruturas() as $estrutura)
                                <option value="{{ $estrutura->id }}"
                                        @if ($estrutura->id == $request->estrutura) selected @endif>
                                    {{ $estrutura->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    {{-- Fornecedor --}}
                    <div class="col-6 col-md-4">
                        <x-inputs.select name="fornecedor" label="Fornecedor">
                            <option value="">Todos</option>
                            @foreach($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}"
                                        @if ($fornecedor->id == $request->fornecedor) selected @endif>
                                    {{ $fornecedor->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>
                <div class="row">
                    {{-- Inversor --}}
                    <div class="col-6 col-md-4">
                        <x-inputs.select name="inversor" label="Inversor">
                            <option value="">Todos</option>
                            @foreach($inversores as $item)
                                <option value="{{ $item->id }}"
                                        @if ($item->id == $request->inversor) selected @endif>
                                    {{ $item->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    {{-- Painel --}}
                    <div class="col-6 col-md-4">
                        <x-inputs.select name="painel" label="Painel">
                            <option value="">Todos</option>
                            @foreach($paineis as $item)
                                <option value="{{ $item->id }}"
                                        @if ($item->id == $request->painel) selected @endif>
                                    {{ $item->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    {{-- Status --}}
                    <div class="col-6 col-md-2">
                        <x-inputs.select label="Status" name="status">
                            <option value="">Todos</option>
                            <option value="1" @if ('1' == $request->status) selected @endif>
                                Ativado
                            </option>
                            <option value="0" @if ('0' == $request->status) selected @endif>
                                Desativado
                            </option>
                        </x-inputs.select>
                    </div>
                    {{-- Status Fornecedor --}}
                    <div class="col-6 col-md-2">
                        <x-inputs.select label="Status no Fornec." name="status_fornecedor">
                            <option value="">Todos</option>
                            <option value="1" @if ('1' == $request->status_fornecedor) selected @endif>
                                Ativado
                            </option>
                            <option value="0" @if ('0' == $request->status_fornecedor) selected @endif>
                                Desativado
                            </option>
                        </x-inputs.select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto align-self-center mx-auto pt-2">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>
    </x-body>
    @if ($kits->isEmpty())
        <div class="row justify-content-center mt--5">
            <div class="col-8">
                <div class="alert alert-info text-center">
                    Não foi encontrado kits.</div>
            </div>
        </div>
    @endif

    @foreach ($kits as $kit)
        <div class="container-fluid mb-2">
            <div class="card shadow">
                <div class="card-body p-0">
                    <div class="border-top p-3 text-sm bg-white">
                        <div class="row">
                            <div class="col">
                                <h4>{{ $kit->modelo }}</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Potência do Kit: {{ $kit->potencia_kit }} kWp<br/>
                                        ID: #{{ $kit->id }}<br>
                                        Status: {{ get_status($kit->status) }}<br/>
                                        Status Fornecedor: {{ get_status($kit->status_fornecedor) }}<br/>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Inversor: {{ $inversores[$kit->marca_inversor]->nome }}<br>
                                        Painel: {{ $paineis[$kit->marca_painel]->nome }}<br>
                                        Estrutura: {{ get_estrutura($kit->estrutura) }}<br>
                                        Tensão: {{ $kit->tensao }} V<br>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Fornecedor: {{ $fornecedores[$kit->fornecedor]->nome ?? '' }}<br>
                                        Preço Cliente: R$ {{ number_format($kit->preco_cliente, 2, ',', '.') }}<br>
                                        Preço Fornecedor R$ {{ number_format($kit->preco_fornecedor, 2, ',', '.') }}<br>
                                        Margem de Venda: {{ $kit->margem }} %
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col small">
                                Atualizado em: {{ date('d/m/y H:i', strtotime($kit->updated_at)) }}
                            </div>
                            <div class="col text-right">
                                <a href="">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row justify-content-center mt-4 mb-6">
        <div class="col-auto">
            {{ $kits->onEachSide(1)->links() }}
        </div>
    </div>
</x-layout>
