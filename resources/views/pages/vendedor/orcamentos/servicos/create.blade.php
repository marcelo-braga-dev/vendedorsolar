<x-layout menu="dimensionamento" submenu="servicos">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --ink:#111827; --muted:#6b7280; --line:#e5e7eb;
            }
            .card-soft{border:1px solid #eef2f6;border-radius:16px;box-shadow:0 8px 26px rgba(0,0,0,.04);background:#fff;}
            .section-title{font-weight:800;font-size:1.05rem;color:var(--ink);}
            .divider{border-top:1px dashed #e9ecef;margin:1rem 0;}
            .btn-brand{display:inline-flex;align-items:center;gap:.5rem;background:var(--brand);border-color:var(--brand);color:#fff;font-weight:700;border-radius:12px;}
            .btn-brand:hover{background:var(--brand-600);border-color:var(--brand-600);color:#fff;}
            .btn-outline-brand{border-color:var(--brand);color:var(--brand);font-weight:700;border-radius:12px;}
            .btn-outline-brand:hover{background:var(--brand);color:#fff;}
            .bi{line-height:0;transform:translateY(-.5px);}
            .is-invalid ~ .invalid-feedback{display:block}
            .chip{display:inline-flex;align-items:center;border:1px solid #e5e7eb;border-radius:999px;padding:.25rem .6rem;font-size:.8rem;margin:.2rem .25rem;background:#fff}
            .chip .dot{width:.5rem;height:.5rem;border-radius:50%;margin-right:.4rem;background:#94a3b8}
            .help{color:var(--muted);font-size:.86rem}
        </style>
    @endpush

    <x-layout.container title="Gerar Proposta de Serviços">
        <div class="card-soft p-3 p-md-4 mb-4">
            <form method="POST" action="{{ route('vendedor.servicos.store') }}" id="form-dimensionamento"> @csrf
                {{-- Seção: Cliente --}}
                <div class="section-title mb-2"><i class="bi bi-person-check me-1"></i> Dados do Cliente</div>
                <div class="row g-3 border-bottom pb-3 mb-3">
                    <div class="col-md-6">
                        <x-inputs.select label="Cliente" name="cliente_id" id="cliente" required>
                            <option value="" selected disabled></option>
                            @foreach ($clientes as $item)
                                <option value="{{ $item->id }}" localidade="{{ $item->cidades_estados_id }}">
                                    {{ getNomeCliente($item->id) }}
                                </option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>

                {{-- Seção: Valores & Prazo --}}
                <div class="section-title mb-2"><i class="bi bi-cash-coin me-1"></i> Valores & Prazo</div>
                <div class="row g-3 border-bottom pb-3 mb-3">
                    <div class="col-md-3">
                        <x-inputs.input-box-left
                            label="Valor da Proposta" type="text" box="R$"
                            name="preco_proposta"
                            id="preco_proposta"
                            step="0.01"
                            data-mask="000.000.000,00"
                            data-mask-reverse="true"
                            value=""
                            required />
                        {{-- Se quiser no backend o valor numérico, usaremos este hidden preenchido no submit --}}
                        <input type="hidden" name="preco_proposta_numeric" id="preco_proposta_numeric" value="">
                    </div>
                    <div class="col-md-3">
                        <x-inputs.input
                            label="Prazo da Proposta"
                            type="date"
                            name="prazo_final"
                            id="prazo_final"
                            value=""
                            required />
                    </div>
                </div>

                {{-- Seção: Conteúdo da Proposta --}}
                <div class="section-title mb-2"><i class="bi bi-file-earmark-text me-1"></i> Conteúdo</div>
                <div class="row g-3">
                    <div class="col-12">
                        <x-inputs.input
                            label="Título da Proposta"
                            name="titulo"
                            id="titulo"
                            type="text"
                            maxlength="120"
                            value=""
                            required />
                    </div>
                    <div class="col-12">
                        <x-inputs.textarea
                            label="Descrição da Proposta"
                            name="descricao"
                            id="descricao"
                            value=""
                            rows="10"
                            required />
                    </div>
                </div>

                {{-- Alerta de validação --}}
                <div class="row px-3 mt-3" id="alert" style="display:none">
                    <div class="alert alert-danger col-12 text-center mb-0">
                        <i class="bi bi-exclamation-octagon me-1"></i> Preencha todos os campos obrigatórios.
                    </div>
                </div>

                {{-- Chips-resumo (aparecem antes do envio quando válidos) --}}
                <div class="row mt-3 mb-2 d-none" id="chips-resumo">
                    <div class="col-12">
                        <div class="chip"><span class="dot"></span> Cliente: <span class="ms-1" id="chip-cliente">—</span></div>
                        <div class="chip"><span class="dot"></span> Valor: <span class="ms-1" id="chip-valor">—</span></div>
                        <div class="chip"><span class="dot"></span> Prazo: <span class="ms-1" id="chip-prazo">—</span></div>
                    </div>
                </div>

                {{-- Ações --}}
                <div class="row justify-content-center mt-3">
                    <div class="col-md-6 text-center">
                        <button type="submit" id="btn-submit" class="btn btn-brand w-100">
                            <i class="bi bi-file-earmark-plus"></i> <span class="label">Gerar Proposta</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @push('js')
            <script>
                $(function () {
                    // título: contador
                    $('#titulo').on('input', function(){
                        $('#titulo_count').text($(this).val().length);
                    });

                    // data mínima = hoje
                    const today = new Date().toISOString().split('T')[0];
                    $('#prazo_final').attr('min', today);

                    // helpers validação
                    function markInvalid($el){
                        $el.addClass('is-invalid');
                        if(!$el.next('.invalid-feedback').length){
                            $el.after('<div class="invalid-feedback">Campo obrigatório.</div>');
                        }
                    }
                    function clearInvalid($el){ $el.removeClass('is-invalid'); $el.next('.invalid-feedback').remove(); }

                    function validateForm(){
                        const ids = ['#cliente','#preco_proposta','#prazo_final','#titulo','#descricao'];
                        let ok = true, first = null;
                        ids.forEach(sel=>{
                            const $el = $(sel); clearInvalid($el);
                            const v = ($el.val()||'').toString().trim();
                            if(!v){ ok=false; if(!first) first=$el; markInvalid($el); }
                        });
                        if(!ok && first){
                            $('#alert').show();
                            $('html, body').animate({scrollTop: Math.max(0, first.offset().top - 100)}, 250);
                            first.focus();
                        }else{
                            $('#alert').hide();
                        }
                        return ok;
                    }

                    // preencher chips-resumo
                    function fillChips(){
                        const clienteTxt = $('#cliente option:selected').text() || '—';
                        const valorTxt = $('#preco_proposta').val() || '—';
                        const prazoTxt = $('#prazo_final').val() || '—';
                        $('#chip-cliente').text(clienteTxt.trim());
                        $('#chip-valor').text('R$ ' + (valorTxt || '—'));
                        $('#chip-prazo').text(prazoTxt);
                        $('#chips-resumo').removeClass('d-none');
                    }

                    // normalizar valor p/ backend numérico (opcional)
                    function normalizeMoneyToNumber(masked){
                        if(!masked) return '';
                        // ex.: "12.345,67" -> "12345.67"
                        return masked.replace(/\./g,'').replace(',','.');
                    }

                    // anti-duplo clique + resumo antes de enviar
                    $('#form-dimensionamento').on('submit', function(e){
                        if(!validateForm()){
                            e.preventDefault();
                            return;
                        }
                        // chips
                        fillChips();

                        // set hidden numérico (caso queira usar no backend)
                        const masked = $('#preco_proposta').val();
                        $('#preco_proposta_numeric').val(normalizeMoneyToNumber(masked));

                        // spinner no botão
                        const $btn = $('#btn-submit');
                        const original = $btn.html();
                        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Gerando...');

                        // deixa seguir o submit normal (POST)
                        // se quiser segurar 300ms só para UX:
                        // setTimeout(()=>this.submit(), 100);
                    });

                    // Remove inválido ao digitar
                    $(document).on('input change', 'input, textarea, select', function(){ clearInvalid($(this)); });
                });
            </script>
        @endpush
    </x-layout.container>
</x-layout>
