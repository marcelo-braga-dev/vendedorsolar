<x-layout menu="integracoes" submenu="eldeltec">
    @push('css')
        <style>
            :root {
                --ink: #0f172a;
                --muted: #64748b;
                --line: #e5e7eb;
                --brand: #e25507;
                --brand-600: #cc4c06;
            }

            .card-soft {
                border: 1px solid #eef2f6;
                border-radius: 16px;
                box-shadow: 0 8px 26px rgba(17, 24, 39, .06);
                background: #fff;
            }

            .table thead th {
                font-weight: 800;
                color: #0f172a;
                border-bottom: 1px solid #eaeef4;
            }

            .table td, .table th {
                vertical-align: middle;
            }

            .badge-soft {
                border: 1px solid #e5e7eb;
                background: #fff;
                border-radius: 999px;
                padding: .25rem .6rem;
                font-weight: 700;
            }

            .badge-ok {
                border-color: #bbf7d0;
                color: #166534;
                background: #f0fdf4
            }

            .badge-warn {
                border-color: #fed7aa;
                color: #9a3412;
                background: #fff7ed
            }

            .badge-err {
                border-color: #fecaca;
                color: #991b1b;
                background: #fef2f2
            }

            .btn-lite {
                border: 1px solid #e5e7eb;
                background: #fff;
                border-radius: 10px;
                padding: .3rem .55rem
            }

            .btn-lite:hover {
                border-color: #d6dae0
            }

            .truncate-1 {
                max-width: 320px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis
            }

            .sticky-tools {
                display: flex;
                gap: .5rem;
                flex-wrap: wrap
            }

            @media (max-width: 767.98px) {
                .truncate-1 {
                    max-width: 160px
                }
            }
        </style>
    @endpush

    <x-body title="Integração Edeltec">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-0">Histórico de Integrações</h5>
                <small class="text-muted">Registros da sincronização com a Edeltec</small>
            </div>
            <div class="sticky-tools">
                <a class="btn btn-success" href="{{ route('admin.integracoes.eldeltec.integrar') }}">
                    <i class="bi bi-play-circle"></i> Iniciar Integração
                </a>
            </div>
        </div>

        <div class="card-soft p-2 p-md-3">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Duração</th>
                        <th>Status</th>
                        <th class="text-center">Importados</th>
                        <th class="text-center">Desativados</th>
                        <th>Anotações</th>
                        <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($historicos as $h)
                        @php
                            $status = strtoupper((string) $h->status);
                            $badgeClass =
                                str_contains($status,'FALH') ? 'badge-err' :
                                (str_contains($status,'CONCLU') || str_contains($status,'OK') ? 'badge-ok' : 'badge-warn');
                        @endphp
                        <tr>
                            <td>#{{ $h->id }}</td>
                            <td>{{ $h->data_inicio_fmt ?? '—' }}</td>
                            <td>{{ $h->data_fim_fmt ?? '—' }}</td>
                            <td>
                                {{ $h->duracao_fmt }}
                            </td>
                            <td><span class="badge-soft {{ $badgeClass }}">{{ $h->status ?? '—' }}</span></td>
                            <td class="text-center">
                                <span class="badge-soft">{{ $h->qtd_importados }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge-soft">{{ $h->qtd_desativados }}</span>
                            </td>
                            <td>
                                <span class="truncate-1" title="{{ $h->anotacoes }}">{{ $h->anotacoes ?: '—' }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @if($h->qtd_importados)
                                        <button class="btn btn-sm btn-lite" data-view-list
                                                data-title="SKUs Importados - #{{ $h->id }}"
                                                data-items="{{ e(json_encode($h->importados)) }}">
                                            Importados
                                        </button>
                                    @endif
                                    @if($h->qtd_desativados)
                                        <button class="btn btn-sm btn-lite" data-view-list
                                                data-title="SKUs Desativados - #{{ $h->id }}"
                                                data-items="{{ e(json_encode($h->desativados)) }}">
                                            Desativados
                                        </button>
                                    @endif
                                    @if($h->anotacoes)
                                        <button class="btn btn-sm btn-lite" data-view-notes
                                                data-title="Anotações - #{{ $h->id }}"
                                                data-notes="{{ e($h->anotacoes) }}">
                                            Notas
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                Nenhum histórico encontrado.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pt-3">
                {{ $historicos->withQueryString()->links() }}
            </div>
        </div>
    </x-body>

    {{-- Modal reusável --}}
    <div class="modal fade" id="modalViewer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalViewerTitle">Detalhes</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalViewerBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            (function(){
                const $modal   = $('#modalViewer');
                const $title   = $('#modalViewerTitle');
                const $body    = $('#modalViewerBody');

                // Lista (importados/desativados)
                $(document).on('click','[data-view-list]',function(){
                    const title = this.getAttribute('data-title') || 'Itens';
                    const raw   = this.getAttribute('data-items') || '[]';
                    let items   = [];
                    try { items = JSON.parse(raw); } catch(e){ items = []; }

                    const html = items.length
                        ? '<ol class="mb-0">' + items.map(x=>`<li><code>${String(x)}</code></li>`).join('') + '</ol>'
                        : '<div class="text-muted">Nada a exibir.</div>';

                    $title.text(title);
                    $body.html(html);
                    $modal.modal('show');
                });

                // Notas
                $(document).on('click','[data-view-notes]',function(){
                    const title = this.getAttribute('data-title') || 'Anotações';
                    const notes = (this.getAttribute('data-notes') || '').replace(/\n/g,'<br>');
                    $title.text(title);
                    $body.html(notes || '<div class="text-muted">Sem anotações.</div>');
                    $modal.modal('show');
                });
            })();
        </script>
    @endpush
</x-layout>
