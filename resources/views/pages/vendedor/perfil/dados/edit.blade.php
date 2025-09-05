<x-layout menu="perfil" submenu="dados">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --ink:#111827; --muted:#6b7280; --line:#e5e7eb;
            }
            .card-soft{border:1px solid #eef2f6;border-radius:16px;box-shadow:0 8px 26px rgba(0,0,0,.04);background:#fff;}
            .section-title{font-weight:800;font-size:1.05rem;color:var(--ink);}
            .btn-brand{display:inline-flex;align-items:center;gap:.5rem;background:var(--brand);border-color:var(--brand);color:#fff;font-weight:700;border-radius:12px;}
            .btn-brand:hover{background:var(--brand-600);border-color:var(--brand-600);color:#fff;}
            .btn-outline-brand{border-color: var(--brand); color: var(--brand); font-weight:700; border-radius:12px;}
            .btn-outline-brand:hover{background:var(--brand); color:#fff;}
            .is-invalid ~ .invalid-feedback{display:block}
            .hint{color:var(--muted); font-size:.86rem}
            /* Radio-as-switch */
            .radioswitch .form-check{padding:.35rem .75rem;border:1px solid #e9ecef;border-radius:12px;margin-right:.5rem;cursor:pointer;}
            .radioswitch .form-check-input{display:none;}
            .radioswitch .form-check-label{font-weight:700;color:#6c757d;}
            .radioswitch .form-check-input:checked + .form-check-label{color:#fff;}
            .radioswitch .form-check:has(.form-check-input:checked){background:var(--brand); border-color:var(--brand);}
        </style>
    @endpush

    <x-layout.container title="Seus Dados">
        <div class="card-soft p-3 p-md-4">
            <form method="POST" action="{{ route('vendedor.perfil.update', $usuario->id) }}" id="form-perfil">
                @csrf @method('put')

                {{-- Seção: Tipo de Pessoa --}}
                @php
                    $isPJ = !empty($dados['cnpj'] ?? '');
                    $isPF = !$isPJ; // se não tem CNPJ, assume PF
                @endphp
                <div class="section-title mb-2"><i class="bi bi-person-badge me-1"></i> Tipo de Pessoa</div>
                <div class="radioswitch d-flex mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo_pessoa" id="tp_pf" value="pf" {{ $isPF ? 'checked' : '' }}>
                        <label class="form-check-label" for="tp_pf"><i class="bi bi-person me-1"></i>Pessoa Física</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo_pessoa" id="tp_pj" value="pj" {{ $isPJ ? 'checked' : '' }}>
                        <label class="form-check-label" for="tp_pj"><i class="bi bi-building me-1"></i>Pessoa Jurídica</label>
                    </div>
                </div>

                {{-- Seção: Dados básicos --}}
                <div class="section-title mb-2"><i class="bi bi-card-text me-1"></i> Dados Básicos</div>
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <x-inputs.input label="Nome" type="text" name="name" id="name" value="{{ $usuario->name }}" required />
                    </div>
                    <div class="col-md-4">
                        <x-inputs.input label="Email" type="email" name="email" id="email" value="{{ $usuario->email }}" required />
                    </div>
                </div>

                {{-- Seção: Documentos (PF/PJ) --}}
                <div class="section-title mb-2"><i class="bi bi-file-earmark-text me-1"></i> Documentos</div>
                <div class="row g-3 mb-3" id="bloco-pf" style="{{ $isPF ? '' : 'display:none' }}">
                    <div class="col-md-3">
                        <x-inputs.input label="CPF" type="text" name="cpf" id="cpf" class="mask-cpf" value="{{ $dados['cpf'] ?? '' }}" />
                        <div class="hint mt-1">Informe apenas se for Pessoa Física.</div>
                    </div>
                    <div class="col-md-3">
                        <x-inputs.input label="RG" type="text" name="rg" id="rg" class="mask-rg" value="{{ $dados['rg'] ?? '' }}" />
                    </div>
                </div>
                <div class="row g-3 mb-3" id="bloco-pj" style="{{ $isPJ ? '' : 'display:none' }}">
                    <div class="col-md-4">
                        <x-inputs.input label="CNPJ" type="text" name="cnpj" id="cnpj" class="mask-cnpj" value="{{ $dados['cnpj'] ?? '' }}" />
                        <div class="hint mt-1">Informe apenas se for Pessoa Jurídica.</div>
                    </div>
                </div>

                {{-- Seção: Contato --}}
                <div class="section-title mb-2"><i class="bi bi-telephone me-1"></i> Contato</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <x-inputs.input label="Celular" type="text" name="celular" id="celular" class="mask-celular" value="{{ $dados['celular'] ?? '' }}" />
                    </div>
                </div>

                {{-- Alerta --}}
                <div class="row px-3 mb-3" id="alert" style="display:none">
                    <div class="alert alert-danger col-12 text-center mb-0">
                        <i class="bi bi-exclamation-octagon me-1"></i> Confira os campos obrigatórios.
                    </div>
                </div>

                {{-- Ações --}}
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <button type="submit" id="btn-submit" class="btn btn-brand w-100">
                            <i class="bi bi-check2-circle"></i> Atualizar Dados
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @push('js')
            <script>
                (function(){
                    const $ = window.jQuery;
                    const tpPF = $('#tp_pf');
                    const tpPJ = $('#tp_pj');
                    const blocoPF = $('#bloco-pf');
                    const blocoPJ = $('#bloco-pj');

                    // campos PF
                    const cpf = $('#cpf');
                    const rg  = $('#rg');
                    // campos PJ
                    const cnpj = $('#cnpj');

                    function setPessoa(tipo){
                        if(tipo === 'pf'){
                            blocoPF.show(); blocoPJ.hide();
                            // PF requer pelo menos CPF OU RG? aqui deixo ambos opcionais,
                            // ajuste se quiser tornar CPF obrigatório:
                            cpf.prop('required', false);
                            rg.prop('required', false);
                            cnpj.prop('required', false);
                            cnpj.removeClass('is-invalid');
                        }else{
                            blocoPF.hide(); blocoPJ.show();
                            cnpj.prop('required', true);
                            // garanta que PF não fique com required
                            cpf.prop('required', false);
                            rg.prop('required', false);
                            cpf.removeClass('is-invalid'); rg.removeClass('is-invalid');
                        }
                    }

                    // estado inicial (usa server-side guess)
                    setPessoa($('input[name="tipo_pessoa"]:checked').val());

                    tpPF.on('change', ()=> setPessoa('pf'));
                    tpPJ.on('change', ()=> setPessoa('pj'));

                    // validação básica
                    function markInvalid($el){
                        $el.addClass('is-invalid');
                        if(!$el.next('.invalid-feedback').length){
                            $el.after('<div class="invalid-feedback">Campo obrigatório.</div>');
                        }
                    }
                    function clearInvalid($el){ $el.removeClass('is-invalid'); $el.next('.invalid-feedback').remove(); }

                    $('#form-perfil').on('submit', function(e){
                        let ok = true, first = null;

                        // sempre obrigatórios
                        ['#name','#email'].forEach(sel=>{
                            const $el = $(sel); clearInvalid($el);
                            const v = ($el.val()||'').toString().trim();
                            if(!v){ ok=false; if(!first) first=$el; markInvalid($el); }
                        });

                        const tipo = $('input[name="tipo_pessoa"]:checked').val();
                        if(tipo === 'pj'){
                            clearInvalid(cnpj);
                            if(!cnpj.val().trim()){ ok=false; if(!first) first=cnpj; markInvalid(cnpj); }
                        }else{
                            // PF: se quiser exigir CPF, troque para required
                            // exemplo opcional:
                            // clearInvalid(cpf);
                            // if(!cpf.val().trim()){ ok=false; if(!first) first=cpf; markInvalid(cpf); }
                        }

                        if(!ok){
                            e.preventDefault();
                            $('#alert').show();
                            $('html, body').animate({scrollTop: Math.max(0, (first || $('#form-perfil')).offset().top - 100)}, 250);
                            (first||$('#name')).focus();
                            return;
                        } else {
                            $('#alert').hide();
                        }

                        // spinner no botão
                        const btn = document.getElementById('btn-submit');
                        const original = btn.innerHTML;
                        btn.disabled = true;
                        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Salvando...';
                        // deixa o submit seguir normalmente
                        // se necessário, restaure no retorno da página
                    });

                    // limpar inválido ao digitar
                    $(document).on('input change', 'input, select', function(){ clearInvalid($(this)); });
                })();
            </script>
        @endpush
    </x-layout.container>
</x-layout>
