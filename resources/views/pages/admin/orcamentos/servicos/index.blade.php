<x-layout menu="orcamentos" submenu="servicos">
    @push('css')
        <style>
            /* Tabela */
            .table thead th{ border-bottom:1px solid #eef2f6; font-weight:700; color:#4a5568; white-space:nowrap; }
            .table tbody tr{ transition: background .15s ease; }
            .table tbody tr:hover{ background:#fcfcfd; }
            .table td, .table th{ vertical-align: middle; }

            /* Valor em destaque */
            .price{ font-weight:800; letter-spacing:.2px; }

            /* Título truncado com tooltip */
            .title-cell{ max-width: 380px; }
            @media (max-width: 991.98px){ .title-cell{ max-width: 260px; } }
            @media (max-width: 575.98px){ .title-cell{ max-width: 160px; } }

            .badge-soft{ border-radius:999px; padding:.3rem .6rem; font-weight:700; font-size:.72rem; border:1px solid transparent; white-space:nowrap; }
            .badge-vencido{ background:rgba(220,53,69,.08); color:#dc3545; border-color:rgba(220,53,69,.22); }
            .badge-no-prazo{ background:rgba(108,117,125,.08); color:#6c757d; border-color:rgba(108,117,125,.18); }
        </style>
    @endpush

    <x-body title="Propostas de Serviços" class="p-0">
        <div class="px-3 pt-3 pb-1">
            <form class="d-flex flex-wrap align-items-end gap-2">
                <div class="flex-grow-1" style="min-width:220px">
                    <x-inputs.input label="Buscar" name="busca" type="text" value="{{ $request->busca }}"
                                    placeholder="Cliente, consultor ou título"></x-inputs.input>
                </div>
                <button type="submit" class="btn btn-primary px-4">Pesquisar</button>
                <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Limpar</a>
                <small class="text-muted ms-auto">{{ $propostas->total() }} proposta(s)</small>
            </form>
        </div>

        <x-tables.data-table-clickable>
            <x-slot name="head">
                <tr>
                    <th class="col-1">ID</th>
                    <th>Cliente</th>
                    <th>Consultor</th>
                    <th>Valor</th>
                    <th>Prazo</th>
                    <th class="title-cell">Título</th>
                    <th class="text-end"></th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @forelse($propostas as $item)
                    @php
                        $prazoRaw = $item->getRawOriginal('prazo_final');
                        $vencido  = $prazoRaw && \Carbon\Carbon::parse($prazoRaw)->isPast();
                    @endphp
                    <tr>
                        <td><strong>#{{ $item->id }}</strong></td>

                        <td>
                            {{ ($item->cliente->nome ?? null) ?: ($item->cliente->razao_social ?? '-') }}
                        </td>

                        <td>
                            <strong>{{ $item->vendedor->name ?? '-' }}</strong>
                        </td>

                        <td class="price">
                            R$ {{ convert_float_money($item->valor) }}
                        </td>

                        <td>
                            @if($prazoRaw)
                                <span class="badge-soft {{ $vencido ? 'badge-vencido' : 'badge-no-prazo' }}">
                                    {{ $item->prazo_final }} @if($vencido) · vencido @endif
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td class="title-cell">
                            @php $titulo = $item->titulo ?? '-'; @endphp
                            <span class="text-truncate d-inline-block w-100" data-bs-toggle="tooltip" title="{{ $titulo }}">
                                {{ $titulo }}
                            </span>
                        </td>

                        <td class="text-end">
                            <a class="btn-ghost" href="{{ route('admin.servicos.show', $item->id) }}">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle"></i> Nenhuma proposta encontrada.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-tables.data-table-clickable>
    </x-body>

    <div class="d-flex justify-content-center my-3">
        {{ $propostas->onEachSide(1)->links() }}
    </div>

    @push('js')
        <script>
            // Ativa tooltip do título (BS5)
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el=>{
                new (window.bootstrap?.Tooltip || function(){}) (el);
            });
        </script>
    @endpush
</x-layout>
