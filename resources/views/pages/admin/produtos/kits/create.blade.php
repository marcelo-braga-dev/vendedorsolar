<x-layout menu="kits_fv" submenu="cadastrar_kit_fv">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --brand-100:#ffe7da; --brand-200:#ffd6c2;
            }
            /* Card e seções */
            .card-soft{ border:1px solid #eef2f6; border-radius:16px; box-shadow:0 8px 26px rgba(0,0,0,.04); }
            .section-title{
                display:flex; align-items:center; gap:.5rem;
                font-weight:700; margin:0 0 .25rem 0;
            }
            .section-title .dot{
                width:10px; height:10px; border-radius:999px; background:var(--brand);
                box-shadow:0 0 0 .18rem rgba(226,85,7,.18);
            }
            .section-subtle{ color:#6c757d; font-size:.925rem; }
            .divider{ border-top:1px dashed #e9ecef; margin:1rem 0; }

            /* Barra de ações do form (cola no fim do card) */
            .form-actions{
                position: sticky; bottom: -1px;
                background: linear-gradient(180deg, rgba(255,255,255,.6), #fff);
                border-top:1px solid #eef2f6; padding: .75rem 1rem; z-index: 5;
                display:flex; justify-content:center;
            }
            .btn-primary{
                background:var(--brand); border-color:var(--brand);
            }
            .btn-primary:hover{ background:var(--brand-600); border-color:var(--brand-600); }
        </style>
    @endpush

    <x-layout.container title="Cadastro de Kit Fotovoltaicos">
        <form method="POST" action="{{ route('admin.produtos.kits.store') }}"> @csrf

            {{-- Identificação do Kit --}}
            <div class="card card-soft mb-4">
                <div class="card-body">
                    <h2 class="section-title"><span class="dot"></span> Identificação do Kit</h2>
                    <p class="section-subtle mb-3">Defina o modelo e um código único (SKU) para identificar o kit.</p>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <x-inputs.input
                                label="Modelo do Kit Fotovoltaico"
                                type="text" name="modelo" value="" required
                            ></x-inputs.input>
                        </div>
                        <div class="col-md-4">
                            <x-inputs.input
                                label="Código do Kit (SKU)"
                                type="text" name="sku"
                            ></x-inputs.input>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Componentes principais --}}
            <div class="card card-soft mb-4">
                <div class="card-body">
                    <h2 class="section-title"><span class="dot"></span> Componentes do Kit</h2>
                    <p class="section-subtle mb-3">Selecione marca e potência do inversor e dos painéis.</p>

                    {{-- Inversor --}}
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <x-inputs.select label="Inversor" name="marca_inversor" required>
                                <option value=""></option>
                                @foreach ($inversores as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                @endforeach
                            </x-inputs.select>
                        </div>
                        <div class="col-md-3">
                            <x-inputs.input-box-right
                                label="Potência do Inversor" name="potencia_inversor" box="kW"
                                type="number" step="0.001" required
                            ></x-inputs.input-box-right>
                        </div>
                    </div>

                    <div class="divider"></div>

                    {{-- Painel --}}
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <x-inputs.select label="Painel" name="marca_painel" required>
                                <option value=""></option>
                                @foreach ($paineis as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                @endforeach
                            </x-inputs.select>
                        </div>
                        <div class="col-md-3">
                            <x-inputs.input-box-right
                                label="Potência dos Painéis" name="potencia_painel" box="W"
                                type="number" required
                            ></x-inputs.input-box-right>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Especificações & Fornecedor --}}
            <div class="card card-soft mb-4">
                <div class="card-body">
                    <h2 class="section-title"><span class="dot"></span> Especificações & Fornecedor</h2>
                    <p class="section-subtle mb-3">Defina potência total do kit, preço do fornecedor, parceiro e demais parâmetros.</p>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <x-inputs.input-box-right
                                label="Potência do Kit" name="potencia_kit" type="number" box="kWp"
                                step="0.001" value="" required
                            ></x-inputs.input-box-right>
                        </div>

                        <div class="col-md-3">
                            <x-inputs.input-box-left
                                label="Preço do Fornecedor" type="text" box="R$"
                                name="preco_fornecedor" step="0.01"
                                data-mask="000.000.000,00" data-mask-reverse="true"
                                value="" required
                            ></x-inputs.input-box-left>
                        </div>

                        <div class="col-md-3">
                            <x-inputs.select label="Fornecedor" name="fornecedor" required>
                                <option value=""></option>
                                @foreach ($fornecedores as $item)
                                    <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                @endforeach
                            </x-inputs.select>
                        </div>

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
                </div>
            </div>

            {{-- Textos / observações --}}
            <div class="card card-soft mb-4">
                <div class="card-body">
                    <h2 class="section-title"><span class="dot"></span> Conteúdo e Observações</h2>
                    <p class="section-subtle mb-3">Descreva os itens do kit e registre observações importantes.</p>

                    <div class="row g-3">
                        <div class="col-12">
                            <x-inputs.textarea
                                label="Produtos do Kit" name="produtos" value="" rows="10" required
                            ></x-inputs.textarea>
                        </div>
                        <div class="col-12">
                            <x-inputs.textarea
                                label="Observações" name="observacoes" value="" rows="3"
                            ></x-inputs.textarea>
                        </div>
                    </div>
                </div>

                {{-- Ações --}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        CADASTRAR KIT
                    </button>
                </div>
            </div>

        </form>
    </x-layout.container>
</x-layout>
