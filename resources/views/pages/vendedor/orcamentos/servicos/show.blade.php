<x-layout menu="orcamentos" submenu="servicos">
    @push('css')
        <style>
            :root{
                --brand:#e25507; --brand-600:#cc4c06; --brand-700:#b44405;
                --ink:#111827; --muted:#6b7280; --line:#e5e7eb;
                --shadow:0 10px 30px rgba(17,24,39,.08);
            }

            .card-soft{border:1px solid #eef2f6;border-radius:16px;box-shadow:0 8px 26px rgba(0,0,0,.04);background:#fff;}
            .section-title{font-weight:800;font-size:1.05rem;color:var(--ink);}
            .subtle{color:var(--muted);}

            .btn-brand{display:inline-flex;align-items:center;gap:.5rem;background:var(--brand);border-color:var(--brand);color:#fff;font-weight:700;border-radius:12px;}
            .btn-brand:hover{background:var(--brand-600);border-color:var(--brand-600);color:#fff;}
            .btn-outline-brand{border-color:var(--brand);color:var(--brand);font-weight:700;border-radius:12px;}
            .btn-outline-brand:hover{background:var(--brand);color:#fff;}

            .bi{line-height:0;transform:translateY(-.5px);}
            .chip{display:inline-flex;align-items:center;border:1px solid #e5e7eb;border-radius:999px;padding:.25rem .6rem;font-size:.8rem;margin:.2rem .25rem;background:#fff}
            .chip .dot{width:.5rem;height:.5rem;border-radius:50%;margin-right:.4rem;background:#94a3b8}

            .header-wrap{display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
            .kv{display:flex;gap:.5rem;flex-wrap:wrap;}
            .kv b{color:var(--ink);}
            .divider{border-top:1px dashed #e9ecef;margin:1rem 0;}
        </style>
    @endpush

    {{-- CABEÇALHO / AÇÕES --}}
    <x-layout.container title="Proposta" class="p-0">
        <div class="card-soft p-3 p-md-4 mb-3">
            <div class="header-wrap">
                <div>
                    <div class="mb-1">
                        <p class="mb-2"><b>Cliente:</b> {{ $proposta->cliente->nome ?? $proposta->cliente->razao_social }}</p>
                        <p class="mb-2"><b>ID Proposta:</b> {{ $proposta->id }}</p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button id="btnGerarPdf"
                            class="btn btn-brand d-inline-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <span class="label">Abrir PDF</span>
                    </button>

                    {{-- Exemplo: copiar link do PDF (quando já existir uma URL gerada e persistida) --}}
                    @if(!empty($proposta->pdf_url ?? null))
                        <a href="{{ $proposta->pdf_url }}" target="_blank" class="btn btn-outline-brand">
                            <i class="bi bi-box-arrow-up-right"></i> Abrir PDF salvo
                        </a>
                    @endif
                </div>
            </div>


        </div>
    </x-layout.container>

    {{-- DETALHES --}}
    <x-layout.container title="Informações da Proposta" class="p-0">
        <div class="card-soft p-3 p-md-4">
            <div class="row">
                <div class="col-12 col-lg-10">
                    <p class="mb-1"><b>Título:</b> {{ $proposta->titulo }}</p>
                    <p class="mb-1"><b>Valor da Proposta:</b> R$ {{ convert_float_money($proposta->valor) }}</p>
                    <p class="mb-1"><b>Prazo:</b> {{ $proposta->prazo_final }}</p>
                    <div class="divider"></div>
                    <p class="mb-1"><b>Descrição:</b></p>
                    <div class="subtle">{!! nl2br(e($proposta->descricao)) !!}</div>
                </div>
            </div>
        </div>
    </x-layout.container>

    {{-- Espaço inferior para respiro em mobile --}}
    <div style="margin-bottom: 130px"></div>

    @push('js')
        <script>
            (function(){
                const btn = document.getElementById('btnGerarPdf');

                async function generatePdf() {
                    // estado de carregando
                    const original = btn.innerHTML;
                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Gerando PDF...';

                    const payload = { id: {{ $proposta->id }} };

                    try {
                        const response = await fetch("{{ route('vendedor.servicos.pdf') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify(payload)
                        });

                        if (!response.ok) {
                            throw new Error('Falha na requisição (' + response.status + ')');
                        }

                        const data = await response.json();
                        const url = data.urlPdf;

                        if (!url) {
                            throw new Error('URL do PDF não retornada.');
                        }

                        // Abre em nova aba e sugere download
                        const a = document.createElement('a');
                        a.href = url;
                        a.target = '_blank';
                        a.setAttribute('download', "{{ ($proposta->cliente->nome ?? $proposta->cliente->razao_social) }}_{{ $proposta->id }}.pdf");
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    } catch (error) {
                        console.error('Erro ao gerar PDF:', error);
                        // feedback simples (você pode trocar por um toast do seu tema)
                        alert('Não foi possível gerar o PDF agora. Tente novamente em instantes.');
                    } finally {
                        btn.disabled = false;
                        btn.innerHTML = original;
                    }
                }

                btn.addEventListener('click', generatePdf);
            })();
        </script>
    @endpush
</x-layout>
