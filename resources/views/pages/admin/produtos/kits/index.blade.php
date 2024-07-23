<x-layout menu="kits_fv" submenu="kits_fv_cadastrados">
    <x-body title="Kits Fotovoltaicos Cadastrados" class="p-0">
        <div class="mb-2">
            <form class="px-3 ">
                <div class="form-row">
                    {{-- Id Kit --}}
                    <div class="col-6 col-md-2">
                        <x-inputs.input label="ID do Kit" name="id" type="number"
                                        value="{{ $request->id }}" placeholder="#000"></x-inputs.input>
                    </div>
                    {{-- Codigo --}}
                    <div class="col-6 col-md-2">
                        <x-inputs.input label="Código" name="codigo" type="text"
                                        value="{{ $request->codigo }}"></x-inputs.input>
                    </div>
                    {{-- Estruturas --}}
                    <div class="col-6 col-md-4">
                        <x-inputs.select name="estrutura" label="Estrutura">
                            <option value="0">Todos</option>
                            @foreach(getEstruturas() as $estrutura)
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
                            <option value="0">Todos</option>
                            @foreach($fornecedores as $fornecedor)
                                <option value="{{ $fornecedor->id }}"
                                        @if ($fornecedor->id == $request->fornecedor) selected @endif>
                                    {{ $fornecedor->nome }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>
                <div class="form-row">
                    {{-- Inversor --}}
                    <div class="col-6 col-md-4">
                        <x-inputs.select name="inversor" label="Inversor">
                            <option value="0">Todos</option>
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
                            <option value="0">Todos</option>
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
                            <option value="0">Todos</option>
                            <option value="1" @if ('1' == $request->status) selected @endif>
                                Desativado
                            </option>
                            <option value="2" @if ('2' == $request->status) selected @endif>
                                Ativado
                            </option>
                        </x-inputs.select>
                    </div>
                    {{-- Status Fornecedor --}}
                    <div class="col-6 col-md-2">
                        <x-inputs.select label="Status no Fornec." name="status_fornecedor">
                            <option value="0">Todos</option>
                            <option value="1" @if ('1' == $request->status_fornecedor) selected @endif>
                                Desativado
                            </option>
                            <option value="2" @if ('2' == $request->status_fornecedor) selected @endif>
                                Ativado
                            </option>
                        </x-inputs.select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto align-self-center mx-auto pt-2">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            <div class="row justify-content-end mb-1">
                <small class="text-muted">Mostrando {{ $kits->total() }} kits.</small>
            </div>
            </form>
        </div>
    </x-body>
    @if ($kits->isEmpty())
        <div class="row justify-content-center mt--5">
            <div class="col-8">
                <div class="alert alert-info text-center">
                    Não foi encontrado kits.
                </div>
            </div>
        </div>
    @endif

    <div class="container-fluid mt--5">
        @foreach ($kits as $kit)
            <div class="card shadow mb-3">
                <div class="card-body p-0">
                    <div class="border-top p-3 text-sm bg-white">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <h4>{{ $kit->modelo }}</h4>
                            </div>
                            <div class="col-6 col-md-2">
                                <img src="{{ asset('storage/'.$imgs[$kit->marca_inversor]['logo']) }}" width="100%" alt="logo">
                            </div>
                            <div class="col-6 col-md-2">
                                <img src="{{ asset('storage/'.$imgs[$kit->marca_painel]['logo']) }}" width="100%" alt="logo">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Potência do Kit: {{ $kit->potencia_kit }} kWp<br/>
                                        ID: #{{ $kit->id }} | Código: {{ $kit->sku ?? '-' }}<br>
                                        Status: <x-status.icon-bool status="{{ $kit->status }}"></x-status.icon-bool><br/>
                                        Status Fornecedor: <x-status.icon-bool status="{{ $kit->status_fornecedor }}"></x-status.icon-bool><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Inversor: {{ $inversores[$kit->marca_inversor]->nome }}<br>
                                        Painel: {{ $paineis[$kit->marca_painel]->nome }}<br>
                                        Estrutura: {{ getEstrutura($kit->estrutura) }}<br>
                                        Tensão: {{ $kit->tensao }} V<br>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        Preço Cliente: R$ {{ convert_float_money(calculaPrecoPrincipalKit($kit->id)) }}<br>
                                        Preço Fornecedor R$ {{ convert_float_money($kit->preco_fornecedor) }}<br>
                                        Margem de Venda: {{ getMargemPrincipal($kit->id) }} %<br>
                                        Fornecedor: {{ $fornecedores[$kit->fornecedor]->nome ?? '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col small">
                                Atualizado em: {{ date('d/m/y H:i', strtotime($kit->updated_at)) }}
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.produtos.kits.edit', $kit->id) }}">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row justify-content-center mt-4 mb-6">
        <div class="col-auto">
            {{ $kits->onEachSide(1)->links() }}
        </div>
    </div>
</x-layout>
