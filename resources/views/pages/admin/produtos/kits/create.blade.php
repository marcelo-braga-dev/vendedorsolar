<x-layout menu="kits_fv" submenu="cadastrar_kit_fv">
    <x-body title="Cadastro de Kit Fotovoltaicos">
        <form method="POST" action="{{ route('admin.produtos.kits.store') }}"> @csrf
            <div class="row">
                <div class="col">
                    <x-inputs.input label="Modelo do Kit Fotovoltaico" type="text" name="modelo" value=""
                                    required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <x-inputs.input label="Código do Kit" type="text" name="sku"></x-inputs.input>
                </div>
            </div>
            <hr>

            {{-- Inversor --}}
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.select label="Inversor" name="marca_inversor" required>
                        <option value=""></option>
                        @foreach ($inversores as $produto)
                            <option value="{{ $produto->id }}">
                                {{ $produto->nome }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Potência do Inversor" name="potencia_inversor" box="kW"
                                              type="number" step="0.001" required>
                    </x-inputs.input-box-right>
                </div>
            </div>

            {{-- Painel --}}
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.select label="Painel" name="marca_painel" required>
                        <option value=""></option>
                        @foreach ($paineis as $produto)
                            <option value="{{ $produto->id }}">
                                {{ $produto->nome }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Potencia dos Painéis" name="potencia_painel" box="W"
                                              type="number" required></x-inputs.input-box-right>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Potência do Kit" name="potencia_kit" type="number" box="kWp"
                                              step="0.001"
                                              value="" required></x-inputs.input-box-right>
                </div>

                <div class="col-md-3">
                    <x-inputs.input-box-left label="Preço do Fornecedor" type="text" box="R$"
                                             name="preco_fornecedor"
                                             step="0.01" data-mask="000.000.000,00" data-mask-reverse="true"
                                             value="" required></x-inputs.input-box-left>
                </div>

                <div class="col-md-3">
                    <x-inputs.select label="Fornecedor" name="fornecedor" required>
                        <option value=""></option>
                        @foreach ($fornecedores as $item)
                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
            </div>
            <div class="row">


                <div class="col-md-3">
                    <x-inputs.select label="Estrutura do Kit" name="estrutura" required>
                        <option value=""></option>
                        @foreach (getEstruturas() as $estrutura)
                            <option value="{{ $estrutura->id }}">{{ $estrutura->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>

                <div class="col-md-3">
                    <x-inputs.select label="Tensão do Kit" name="tensao" required>
                        <option value=""></option>
                        <option value="220">220 V</option>
                        <option value="380">380 V</option>
                    </x-inputs.select>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Produtos do Kit" name="produtos" value="" rows="10"
                                       required></x-inputs.textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Observações" name="observacoes" value="" rows="2"></x-inputs.textarea>
                </div>
            </div>
            <div class="row p-4">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">CADASTRAR KIT</button>
                </div>
            </div>
        </form>
    </x-body>
</x-layout>
