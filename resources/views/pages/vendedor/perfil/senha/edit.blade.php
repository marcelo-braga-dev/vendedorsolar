<x-layout menu="perfil" submenu="senha">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --ink:#111827; --muted:#6b7280; --line:#e5e7eb;
            }
            .card-soft{border:1px solid #eef2f6;border-radius:16px;box-shadow:0 8px 26px rgba(0,0,0,.04);background:#fff;}
            .section-title{font-weight:800;font-size:1.05rem;color:var(--ink);}
            .hint{color:var(--muted);font-size:.86rem}
            .btn-brand{display:inline-flex;align-items:center;gap:.5rem;background:var(--brand);border-color:var(--brand);color:#fff;font-weight:700;border-radius:12px;}
            .btn-brand:hover{background:var(--brand-600);border-color:var(--brand-600);color:#fff;}
            .is-invalid ~ .invalid-feedback{display:block}

            /* input with reveal button */
            .pw-wrap{position:relative}
            .pw-toggle{position:absolute; right:.75rem; top:50%; transform:translateY(-50%); border:0; background:transparent; color:#6b7280}
            .pw-toggle:focus{outline:none}

            /* binary meter */
            .pw-meter{height:8px; border-radius:8px; background:#e5e7eb; overflow:hidden}
            .pw-meter > span{display:block; height:100%; width:0%; background:#ef4444; transition:width .2s ease, background .2s ease; border-radius:8px}
            .pw-strength-label{font-size:.85rem; color:var(--muted)}
        </style>
    @endpush>

    <x-layout.container title="Atualizar Senha">
        <div class="card-soft p-3 p-md-4">
            <form method="POST" action="{{ route('vendedor.senha.update', $usuario->id) }}" id="form-senha">
                @csrf @method('put')

                <div class="section-title mb-2"><i class="bi bi-shield-lock me-1"></i> Segurança</div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="pw-wrap">
                            <x-inputs.input label="Senha atual" type="password" name="senha_atual" id="senha_atual" required />
                            <button class="pw-toggle" type="button" data-target="#senha_atual" aria-label="Mostrar/ocultar senha">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <div class="pw-wrap">
                            <x-inputs.input label="Nova Senha" type="password" name="nova_senha" id="nova_senha" required />
                            <button class="pw-toggle" type="button" data-target="#nova_senha" aria-label="Mostrar/ocultar senha">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>

                        <div class="pw-meter mt-2"><span id="pw-bar"></span></div>
                        <div class="d-flex justify-content-between mt-1">
                            <div class="pw-strength-label" id="pw-label">Requisito: mínimo 8 caracteres</div>
                            <div class="hint">Mín. 8 caracteres</div>
                        </div>
                        <ul class="hint mt-2 mb-0" id="pw-rules">
                            <li data-rule="len">Pelo menos 8 caracteres</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <div class="pw-wrap">
                            <x-inputs.input label="Repetir Nova Senha" type="password" name="repetir_senha" id="repetir_senha" required />
                            <button class="pw-toggle" type="button" data-target="#repetir_senha" aria-label="Mostrar/ocultar senha">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="hint mt-2" id="match-hint">As senhas devem coincidir.</div>
                    </div>
                </div>

                {{-- Alerta genérico --}}
                <div class="row px-3 mt-3" id="alert" style="display:none">
                    <div class="alert alert-danger col-12 text-center mb-0">
                        <i class="bi bi-exclamation-octagon me-1"></i> Corrija os campos destacados.
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-md-4">
                        <button type="submit" id="btn-submit" class="btn btn-brand w-100">
                            <i class="bi bi-check2-circle"></i> Atualizar Senha
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @push('js')
            <script>
                (function(){
                    const $ = window.jQuery;
                    const MIN_LEN = 8;

                    // Mostrar/ocultar senhas
                    $(document).on('click', '.pw-toggle', function(){
                        const target = $(this).data('target');
                        const $inp = $(target);
                        const $icon = $(this).find('i');
                        if($inp.attr('type') === 'password'){
                            $inp.attr('type','text'); $icon.removeClass('bi-eye').addClass('bi-eye-slash');
                        } else {
                            $inp.attr('type','password'); $icon.removeClass('bi-eye-slash').addClass('bi-eye');
                        }
                    });

                    // Helpers
                    function markInvalid($el){
                        $el.addClass('is-invalid');
                        if(!$el.next('.invalid-feedback').length){
                            $el.after('<div class="invalid-feedback">Campo inválido.</div>');
                        }
                    }
                    function clearInvalid($el){ $el.removeClass('is-invalid'); $el.next('.invalid-feedback').remove(); }

                    // Checagens simples
                    function meetsLen(v){ return (v||'').length >= MIN_LEN; }
                    function renderMeter(v){
                        const ok = meetsLen(v);
                        $('#pw-bar').css({ width: ok ? '100%' : '0%', background: ok ? '#16a34a' : '#ef4444' });
                        $('#pw-label').text(ok ? 'Requisito atendido (≥ 8 caracteres)' : 'Requisito: mínimo 8 caracteres');
                        const $li = $('#pw-rules [data-rule="len"]');
                        $li.css('color', ok ? '#16a34a' : '#6b7280')
                            .css('text-decoration', ok ? 'line-through' : 'none');
                    }
                    function checkMatch(){
                        const a = $('#nova_senha').val();
                        const b = $('#repetir_senha').val();
                        const ok = !!a && a === b;
                        $('#match-hint').text(ok ? 'Senhas coincidem.' : 'As senhas devem coincidir.')
                            .css('color', ok ? '#16a34a' : '#6b7280');
                        return ok;
                    }

                    // Eventos
                    $('#nova_senha').on('input', function(){
                        const v = $(this).val();
                        renderMeter(v);
                        if(v){ clearInvalid($(this)); }
                        checkMatch();
                    });
                    $('#repetir_senha').on('input', function(){
                        if($(this).val()){ clearInvalid($(this)); }
                        checkMatch();
                    });

                    // Submit
                    $('#form-senha').on('submit', function(e){
                        let ok = true, first = null;
                        const atual = $('#senha_atual');
                        const nova  = $('#nova_senha');
                        const rep   = $('#repetir_senha');

                        [atual, nova, rep].forEach($el=>{
                            clearInvalid($el);
                            if(!($el.val()||'').trim()){
                                ok = false; if(!first) first=$el; markInvalid($el);
                            }
                        });

                        if(!meetsLen(nova.val())) { ok = false; if(!first) first=nova; markInvalid(nova); }
                        if(nova.val() !== rep.val()) { ok = false; if(!first) first=rep; markInvalid(rep); }

                        if(!ok){
                            e.preventDefault();
                            $('#alert').show();
                            $('html, body').animate({scrollTop: Math.max(0, (first||$('#form-senha')).offset().top - 100)}, 250);
                            (first||nova).focus();
                            return;
                        } else {
                            $('#alert').hide();
                        }

                        // spinner no botão
                        const btn = document.getElementById('btn-submit');
                        btn.disabled = true;
                        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Atualizando...';
                    });

                    // Limpa inválido ao alterar
                    $(document).on('input change', 'input', function(){ clearInvalid($(this)); });
                })();
            </script>
        @endpush
    </x-layout.container>
</x-layout>
