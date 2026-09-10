<x-layout menu="orcamentos" submenu="todos_orcamentos">
    @push('css')
        <style>
            /* Card/table polish */
            .card-soft{ border:1px solid #eef2f6; border-radius:16px; box-shadow:0 8px 26px rgba(0,0,0,.04); }
            .table thead th{ border-bottom:1px solid #eef2f6; font-weight:700; color:#4a5568; }
            .table tbody tr{ transition: background .15s ease, transform .08s ease; }
            .table tbody tr:hover{ background:#fcfcfd; }
            .table td, .table th{ vertical-align: middle; }

            /* Status badge */
            .badge-soft{ border-radius:999px; padding:.35rem .6rem; font-weight:800; font-size:.72rem; border:1px solid transparent; }
            .badge-novo{ background:rgba(13,110,253,.08); color:#0d6efd; border-color:rgba(13,110,253,.18); }
            .badge-assinado{ background:rgba(111,66,193,.08); color:#6f42c1; border-color:rgba(111,66,193,.18); }
            .badge-aprovado{ background:rgba(25,135,84,.10); color:#198754; border-color:rgba(25,135,84,.25); }
            .badge-instalando{ background:rgba(255,193,7,.10); color:#856404; border-color:rgba(255,193,7,.25); }
            .badge-finalizado{ background:rgba(33,37,41,.08); color:#212529; border-color:rgba(33,37,41,.16); }

            /* Chips de filtro */
            .chip{
                display:inline-flex; align-items:center; gap:.4rem; height:32px;
                padding:0 .85rem; border:1px solid #e7eaef; border-radius:999px;
                background:#fff; color:#495057; font-weight:700; font-size:.85rem;
                transition:all .2s ease; text-decoration:none;
            }
            .chip:hover{ background:#f8f9fb; }
            .chip.active{ border-color:var(--brand); color:var(--brand-700); background:var(--brand-100); }
            .chip .dot{ width:8px; height:8px; border-radius:999px; background:#adb5bd; }
            .chip.active .dot{ background:var(--brand); }
        </style>
    @endpush

    <x-body title="{{ $label }}" class="p-0">
        <div class="px-3 pt-3 pb-1">
            {{-- Filtros rápidos por status --}}
            @php
                $st = strtolower(request('status',''));
                $urlBase = request()->url();
                // fecha sobre $urlBase/$request; preserva a busca ativa ao trocar de status
                $chipUrl = function (?string $key) use ($urlBase, $request) {
                    $params = $key ? ['status' => $key] : [];
                    if ($request->filled('busca')) {
                        $params['busca'] = $request->busca;
                    }
                    return $params ? $urlBase.'?'.http_build_query($params) : $urlBase;
                };
                $statusOnlyUrl = $request->status ? $urlBase.'?status='.$request->status : $urlBase;
            @endphp
            <div class="d-flex flex-wrap gap-3 mb-3">
                <a href="{{ $chipUrl(null) }}" class="me-2 mr-2 chip {{ $st==='' ? 'active':'' }}"><span class="dot"></span> Todos</a>
                <a href="{{ $chipUrl('novos') }}" class="mr-2 chip {{ $st==='novos' ? 'active':'' }}"><span class="dot"></span> Novos</a>
                <a href="{{ $chipUrl('assinados') }}" class="mr-2 chip {{ $st==='assinados' ? 'active':'' }}"><span class="dot"></span> Assinados</a>
                <a href="{{ $chipUrl('aprovados') }}" class="mr-2 chip {{ $st==='aprovados' ? 'active':'' }}"><span class="dot"></span> Aprovados</a>
                <a href="{{ $chipUrl('instalandos') }}" class="mr-2 chip {{ $st==='instalandos' || $st==='instalando' ? 'active':'' }}"><span class="dot"></span> Instalando</a>
                <a href="{{ $chipUrl('finalizados') }}" class="mr-2 chip {{ $st==='finalizados' ? 'active':'' }}"><span class="dot"></span> Finalizados</a>
            </div>

            {{-- Busca por cliente, vendedor ou ID --}}
            <form class="d-flex flex-wrap align-items-end gap-2 mb-2">
                <input type="hidden" name="status" value="{{ $request->status }}">
                <div class="flex-grow-1" style="min-width:220px">
                    <x-inputs.input label="Buscar" name="busca" type="text" value="{{ $request->busca }}"
                                    placeholder="Cliente, vendedor ou #ID"></x-inputs.input>
                </div>
                <button type="submit" class="btn btn-primary px-4">Pesquisar</button>
                @if($request->filled('busca'))
                    <a href="{{ $statusOnlyUrl }}" class="btn btn-outline-secondary">Limpar</a>
                @endif
            </form>
        </div>

        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th>ID</th>
                    <th>Data Criação</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th class="text-end"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @foreach($orcamentos as $item)
                    @php
                        $statusText = getStatusOrcamentos($item->status);
                        $s = strtolower($statusText);
                        $badgeClass = match(true){
                            str_contains($s,'novo') => 'badge-novo',
                            str_contains($s,'assinado') => 'badge-assinado',
                            str_contains($s,'aprov') => 'badge-aprovado',
                            str_contains($s,'instal') => 'badge-instalando',
                            str_contains($s,'final') => 'badge-finalizado',
                            default => 'badge-novo',
                        };

                        $c = $clientesMap[$item->clientes_id] ?? null;
                        $nomeCliente = match(true) {
                            !$c => '-',
                            (bool) ($c->nome && $c->razao_social) => "{$c->nome} - {$c->razao_social}",
                            (bool) $c->nome => $c->nome,
                            (bool) $c->razao_social => $c->razao_social,
                            default => '-',
                        };
                    @endphp
                    <tr>
                        <td><strong>#{{ $item->id }}</strong></td>

                        <td>
                            {{ date('d/m/y', strtotime($item->created_at)) }}<br>
                            <small class="text-muted">{{ date('H:i', strtotime($item->created_at)) }}</small>
                        </td>

                        <td>
                            <b>{{ $vendedor[$item->users_id] ?? '-' }}</b>
                        </td>

                        <td>
                            {{ $nomeCliente }}
                        </td>

                        <td>
                            <strong>R$ {{ convert_float_money($item->preco_cliente) }}</strong>
                        </td>

                        <td>
                            <span class="badge-soft {{ $badgeClass }}">{{ $statusText }}</span>
                        </td>

                        <td class="text-end">
                            <a class="btn-ghost" href="{{ route('admin.orcamentos.show', $item->id) }}">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-tables.data-table-clickable>

        {{-- Paginação --}}
        <div class="d-flex justify-content-center my-3">
            {{ $orcamentos->onEachSide(1)->links() }}
        </div>
    </x-body>
</x-layout>
