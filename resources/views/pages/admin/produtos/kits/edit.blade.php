<x-layout menu="kits_fv" submenu="">
    <x-body title="Editar Informações do Kit">
        <form method="POST" action="{{ route('admin.produtos.kits.update', $kit->id) }}"> @csrf @method('PUT')
            <div class="row">
                <div class="col-12">
                    <x-inputs.input label="Modelo do Kit Fotovoltaico" type="text" name="modelo"
                                    value="{{ $kit->modelo }}" required></x-inputs.input>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <x-inputs.input label="Código do Kit" type="text" name="sku"
                                    value="{{ $kit->sku }}"></x-inputs.input>
                </div>
                <div class="col-3">
                    <x-inputs.select label="Status no Fornecedor" name="status_fornecedor" required>
                        <option value="0">
                            Indisponível
                        </option>
                        <option value="1"
                                @if ($kit->status_fornecedor) selected @endif>
                            Disponível
                        </option>
                    </x-inputs.select>
                </div>
            </div>
            <hr>

            {{-- Inversor --}}
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.select label="Inversor" name="marca_inversor" required>
                        @foreach ($inversores as $produto)
                            <option value="{{ $produto->id }}"
                                    @if ($kit->marca_inversor == $produto->id) selected @endif>
                                {{ $produto->nome }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Potência do Inversor" name="potencia_inversor" box="kW"
                                              type="number" step="0.001" value="{{ $kit->potencia_inversor }}" required>
                    </x-inputs.input-box-right>
                </div>
            </div>

            {{-- Painel --}}
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.select label="Painel" name="marca_painel" required>
                        <option value=""></option>
                        @foreach ($paineis as $produto)
                            <option value="{{ $produto->id }}"
                                    @if ($kit->marca_painel == $produto->id) selected @endif>
                                {{ $produto->nome }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Potencia dos Painéis" name="potencia_painel" box="W"
                                              type="number" value="{{ $kit->potencia_painel }}"
                                              required></x-inputs.input-box-right>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-3">
                    <x-inputs.input-box-right label="Potência do Kit" name="potencia_kit" type="number" box="kWp"
                                              step="0.001" value="{{ $kit->potencia_kit }}"
                                              required></x-inputs.input-box-right>
                </div>

                <div class="col-md-3">
                    <x-inputs.input-box-left label="Preço do Fornecedor" type="text" box="R$"
                                             name="preco_fornecedor"
                                             step="0.01" data-mask="000.000.000,00" data-mask-reverse="true"
                                             value="{{  convert_float_money($kit->preco_fornecedor) }}"
                                             required></x-inputs.input-box-left>
                </div>

                <div class="col-md-3">
                    <x-inputs.select label="Fornecedor" name="fornecedor" required>
                        <option value=""></option>
                        @foreach ($fornecedores as $item)
                            <option value="{{ $item->id }}"
                                    @if ($kit->fornecedor == $item->id) selected @endif>{{ $item->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
            </div>
            <div class="row">


                <div class="col-md-3">
                    <x-inputs.select label="Estrutura do Kit" name="estrutura" required>
                        <option value=""></option>
                        @foreach (getEstruturas() as $estrutura)
                            <option value="{{ $estrutura->id }}"
                                    @if ($kit->estrutura == $estrutura->id) selected @endif>{{ $estrutura->nome }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>

                <div class="col-md-3">
                    <x-inputs.select label="Tensão do Kit" name="tensao" required>
                        <option value="220">220 V</option>
                        <option value="380" @if ($kit->tensao == 380) selected @endif>380 V</option>
                    </x-inputs.select>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Produtos do Kit" name="produtos" value="" rows="10"
                                       required>{{ $kit->produtos }}</x-inputs.textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-inputs.textarea label="Observações" name="observacoes" value=""
                                       rows="2">{{ $kit->observacoes }}</x-inputs.textarea>
                </div>
            </div>
            <div class="row justify-content-end">
                <button type="button" id="btn-deletar" class="btn btn-link text-danger py-0">
                    <i class="fas fa-trash-alt"></i> Excluir kit
                </button>
            </div>
            <div class="row mb-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
        <form method="POST" id="form-delete"
              action="{{ route('admin.produtos.kits.destroy', $kit->id) }}"> @csrf @method('DELETE')

        </form>
    </x-body>
    @push('js')
        <script>
            $('#btn-deletar').click(function () {
                Swal.fire({
                    confirmButtonColor: 'red',
                    icon: 'warning',
                    title: 'Deletar Kit',
                    input: 'checkbox',
                    inputValue: 0,
                    inputPlaceholder:
                        'Confirmar. Essa ação é irreversível.',
                    showCancelButton: true,
                    confirmButtonText:
                        '<i class="fa fa-trash-alt"></i> Deletar',
                    inputValidator: (result) => {
                        return !result && 'Você precisa marcar a opção de confirmar.'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete').submit();
                    }
                });
            })
        </script>
    @endpush
</x-layout>
