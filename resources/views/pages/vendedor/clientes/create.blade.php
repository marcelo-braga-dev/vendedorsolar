<x-layout menu="clientes" submenu="cadastrar">
    @push('css')
        <style>
            :root {
                --brand: #e25507;
                --line: #eef1f5;
                --muted: #6b7280;
                --card: #fff;
                --bg: #f7f9fc;
            }

            .wrap {
                background: var(--bg);
                border-radius: 16px;
                padding: 1rem
            }

            .card-soft {
                background: var(--card);
                border: 1px solid var(--line);
                border-radius: 14px;
                box-shadow: 0 10px 24px rgba(16, 24, 40, .05)
            }

            .section-title {
                display: flex;
                align-items: center;
                gap: .5rem;
                margin: 0 0 .75rem
            }

            .section-title i {
                color: var(--muted)
            }

            .radio-chip {
                display: flex;
                gap: .5rem;
                flex-wrap: wrap
            }

            .radio-chip input {
                display: none
            }

            .radio-chip label {
                padding: .55rem .9rem;
                border: 1px solid var(--line);
                border-radius: 999px;
                cursor: pointer;
                font-weight: 700;
                color: #111827;
                background: #fff;
            }

            .radio-chip input:checked + label {
                background: var(--brand);
                color: #fff;
                border-color: var(--brand);
            }

            .divider {
                border-top: 1px dashed var(--line);
                margin: 1rem 0
            }

            .hint {
                color: var(--muted);
                font-size: .85rem
            }
        </style>
    @endpush

    <x-layout.container title="Cadastrar Cliente">
        <form method="POST" id="form-cliente" action="{{ route('vendedor.clientes.store') }}"> @csrf
            {{-- Tipo de Cliente --}}
            <div class="card-soft p-3 p-md-4 mb-3">
                <div class="section-title">
                    <i class="fas fa-user-check"></i>
                    <h5 class="mb-0">Tipo de Cliente</h5>
                </div>
                <div class="radio-chip">
                    <input type="radio" id="tipo_pf" name="tipo_pessoa" value="pf" checked>
                    <label for="tipo_pf"><i class="fas fa-id-card me-1"></i> Pessoa Física</label>

                    <input type="radio" id="tipo_pj" name="tipo_pessoa" value="pj">
                    <label for="tipo_pj"><i class="fas fa-building me-1"></i> Pessoa Jurídica</label>
                </div>
            </div>

            {{-- Dados do Cliente --}}
            <div class="card-soft p-3 p-md-4 mb-3">
                <div class="section-title">
                    <i class="fas fa-address-card"></i>
                    <h5 class="mb-0">Dados do Cliente</h5>
                </div>

                {{-- Pessoa Física --}}
                <div id="box-pf">
                    <div class="form-row">
                        <div class="col-md-6">
                            <x-inputs.input label="Nome Completo" name="nome" id="nome" type="text"/>
                        </div>
                        <div class="col-6 col-md-3">
                            <x-inputs.input label="CPF" name="cpf" type="text" class="mask-cpf"/>
                        </div>
                        <div class="col-6 col-md-3">
                            <x-inputs.input label="RG" name="rg" type="text" class="mask-rg"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 col-md-3">
                            <x-inputs.input label="Data de Nascimento" name="data_nascimento" type="text" class="mask-data"/>
                        </div>
                    </div>
                </div>

                {{-- Pessoa Jurídica --}}
                <div id="box-pj" class="d-none">
                    <div class="form-row">
                        <div class="col-md-4">
                            <x-inputs.input label="CNPJ" name="cnpj" id="cnpj" type="text" class="mask-cnpj"/>
                        </div>
                        <div class="col-md-8">
                            <x-inputs.input label="Razão Social" name="razao_social" id="razao_social" type="text"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <x-inputs.input label="Inscrição Estadual" name="inscricao_social" id="inscricao_social" type="text"/>
                        </div>
                        <div class="col-md-8">
                            <x-inputs.input label="Nome Fantasia" name="nome_fantasia" id="nome_fantasia" type="text"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contato --}}
            <div class="card-soft p-3 p-md-4 mb-3">
                <div class="section-title">
                    <i class="fas fa-phone-square"></i>
                    <h5 class="mb-0">Contato</h5>
                </div>
                <div class="form-row">
                    <div class="col-6 col-md-3">
                        <x-inputs.input label="Celular" name="celular" type="text" class="mask-celular"/>
                    </div>
                    <div class="col-6 col-md-3">
                        <x-inputs.input label="Telefone" name="telefone" type="text" class="mask-telefone"/>
                    </div>
                    <div class="col-md-6">
                        <x-inputs.input label="E-mail" name="email" type="email"/>
                    </div>
                </div>
            </div>

            {{-- Endereço --}}
            <div class="card-soft p-3 p-md-4 mb-3">
                <div class="section-title">
                    <i class="fas fa-map-marked-alt"></i>
                    <h5 class="mb-0">Endereço</h5>
                </div>
                <div class="form-row">
                    <div class="col-6 col-md-3">
                        <x-inputs.input label="CEP" name="cep" id="cep" type="text" class="mask-cep"/>
                    </div>
                    <div class="col-md-6">
                        <x-inputs.input label="Rua / Av." name="endereco" id="endereco" type="text"/>
                    </div>
                    <div class="col-12 col-md-3">
                        <x-inputs.input label="Complemento" name="complemento" type="text"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6 col-md-2">
                        <x-inputs.input label="Número" name="numero" id="numero" type="text"/>
                    </div>
                    <div class="col-12 col-md-4">
                        <x-inputs.input label="Bairro" name="bairro" id="bairro" type="text"/>
                    </div>
                    <div class="col-12 col-md-3">
                        <x-inputs.select label="Estado" name="estado" id="estado">
                            <option value=""></option>
                            @foreach (getEstados() as $estado)
                                <option value="{{ $estado->sigla }}">{{ $estado->estado }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                    <div class="col-12 col-md-3">
                        <x-inputs.select label="Cidade" name="cidade" id="cidade"></x-inputs.select>
                    </div>
                </div>
            </div>

            {{-- Anotações --}}
            <div class="card-soft p-3 p-md-4 mb-3">
                <div class="section-title">
                    <i class="fas fa-sticky-note"></i>
                    <h5 class="mb-0">Anotações</h5>
                </div>
                <x-inputs.textarea label="Anotações" name="anotacoes" id="anotacoes"></x-inputs.textarea>
            </div>

            {{-- Alert & Submit --}}
            <div class="alert alert-danger d-none" id="alert"></div>

            <div class="text-center mt-3">
                <button type="submit" id="btn-submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i> Cadastrar Cliente
                </button>
            </div>
        </form>
    </x-layout.container>

    @push('js')
        <script>
            // habilita/desabilita inputs dentro de um container
            function toggleBox(boxId, show) {
                const el = document.getElementById(boxId);
                if (!el) return;
                el.classList.toggle('d-none', !show);
                el.querySelectorAll('input,select,textarea').forEach(i => {
                    if (show) {
                        i.removeAttribute('disabled');
                    } else {
                        i.setAttribute('disabled', 'disabled');
                    }
                });
            }

            // estado inicial: Pessoa Física
            toggleBox('box-pf', true);
            toggleBox('box-pj', false);

            // troca conforme radios
            document.getElementById('tipo_pf').addEventListener('change', e => {
                if (e.target.checked) {
                    toggleBox('box-pf', true);
                    toggleBox('box-pj', false);
                }
            });
            document.getElementById('tipo_pj').addEventListener('change', e => {
                if (e.target.checked) {
                    toggleBox('box-pj', true);
                    toggleBox('box-pf', false);
                }
            });

            // validação no submit
            document.getElementById('form-cliente').addEventListener('submit', function (e) {
                const isPF = document.getElementById('tipo_pf').checked;
                const alertBox = document.getElementById('alert');
                alertBox.classList.add('d-none');
                alertBox.innerText = '';

                const nome = document.getElementById('nome').value.trim();
                if (isPF) {
                    if (!nome) {
                        e.preventDefault();
                        alertBox.innerText = 'Informe o Nome do Cliente.';
                        alertBox.classList.remove('d-none');
                        return;
                    }
                } else {
                    const razao = document.getElementById('razao_social').value.trim();
                    if (!razao) {
                        e.preventDefault();
                        alertBox.innerText = 'Informe a Razão Social do Cliente.';
                        alertBox.classList.remove('d-none');
                        return;
                    }
                }

                const cidade = document.getElementById('cidade').value.trim();
                const estado = document.getElementById('estado').value.trim();
                if (!cidade || !estado) {
                    e.preventDefault();
                    alertBox.innerText = 'Selecione a Cidade e o Estado.';
                    alertBox.classList.remove('d-none');
                }
            });
        </script>

        {{-- utilidades já existentes no projeto --}}
        <script src="{{ asset('assets') }}/js/select-cidades-estados.js"></script>
        <script src="{{ asset('assets') }}/js/pesquisa-cep.js"></script>
        <script src="{{ asset('assets') }}/js/pesquisa-cnpj.js"></script>
    @endpush
</x-layout>
