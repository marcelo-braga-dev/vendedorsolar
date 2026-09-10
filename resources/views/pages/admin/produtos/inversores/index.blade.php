<x-layout menu="produtos" submenu="inversores">
    @push('css')
        <style>
            /* ===== Grid de marcas ===== */
            .marca-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 1.5rem;
            }

            .marca-card {
                display: flex;
                flex-direction: column;
                background: #fff;
                border: 1px solid #eef2f6;
                border-radius: 16px;
                overflow: hidden;
            }

            .marca-card:hover {
                box-shadow: 0 16px 40px rgba(0, 0, 0, .06);
                transform: translateY(-2px);
                transition: .18s ease;
            }

            /* Foto do produto — tamanho fixo, padronizado com as demais páginas */
            .marca-photo {
                width: 100%;
                height: 130px;
                background: #fafbfc;
                border-bottom: 1px solid #eef2f6;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            .marca-photo img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }

            .marca-photo .no-photo {
                color: #d5dae0;
                font-size: 2.4rem;
            }

            .marca-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                gap: .55rem;
                padding: 1.1rem 1.15rem 1rem;
            }

            .marca-logo-row {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 30px;
            }

            .marca-logo-row img {
                max-width: 130px;
                max-height: 100%;
                object-fit: contain;
            }

            .marca-title {
                margin: 0;
                font-weight: 800;
                font-size: .98rem;
                text-align: center;
                color: #212529;
            }

            .marca-badges {
                display: flex;
                gap: .35rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .badge-soft {
                border-radius: 999px;
                padding: .3rem .6rem;
                font-weight: 700;
                font-size: .68rem;
                border: 1px solid transparent;
                white-space: nowrap;
            }

            .badge-categoria {
                background: #eef2f7;
                color: #495057;
                border-color: #e2e8f0;
            }

            .marca-garantia {
                min-height: 2.05rem;
                font-size: .74rem;
                color: #8891a0;
                text-align: center;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                line-height: 1.35;
            }

            .marca-stat {
                margin-top: auto;
                text-align: center;
                font-size: .78rem;
                font-weight: 600;
                color: #495057;
                background: #f8f9fb;
                border: 1px solid #eef2f6;
                border-radius: 8px;
                padding: .4rem .5rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: .1rem;
                line-height: 1.3;
            }

            .marca-actions {
                padding-top: .65rem;
                border-top: 1px dashed #eef2f6;
                display: flex;
                justify-content: center;
            }

            .btn-marca-edit {
                display: inline-flex;
                align-items: center;
                gap: .45rem;
                background: var(--brand);
                border: 1px solid var(--brand);
                color: #fff;
                border-radius: 10px;
                padding: .4rem .9rem;
                font-weight: 700;
                font-size: .82rem;
            }

            .btn-marca-edit:hover {
                background: var(--brand-600);
                border-color: var(--brand-600);
                color: #fff;
                text-decoration: none;
            }
        </style>
    @endpush

    <x-body title="Inversores"
            class="p-0"
            text-button="Cadastrar Marca de Inversor"
            url-button="{{ route('admin.produtos.inversores.create') }}">

        <div class="marca-grid p-3">
            @forelse($inversores as $item)
                @php($stat = $kitsPorMarca[$item->id] ?? null)
                <div class="marca-card">
                    <div class="marca-photo">
                        @if($item->img_produto)
                            <img src="{{ asset('storage/'.$item->img_produto) }}" alt="Foto do inversor {{ $item->nome }}" loading="lazy">
                        @else
                            <i class="fas fa-bolt no-photo"></i>
                        @endif
                    </div>
                    <div class="marca-body">
                        <div class="marca-logo-row">
                            @if($item->img_logo)
                                <img src="{{ asset('storage/'.$item->img_logo) }}" alt="Logo {{ $item->nome }}">
                            @endif
                        </div>
                        <h6 class="marca-title">{{ $item->nome }}</h6>
                        @if($item->categoria)
                            <div class="marca-badges">
                                <span class="badge-soft badge-categoria">{{ ucfirst($item->categoria) }}</span>
                            </div>
                        @endif
                        <div class="marca-garantia" title="{{ $item->garantia }}">
                            @if($item->garantia)
                                <i class="fas fa-shield-alt"></i> {{ $item->garantia }}
                            @endif
                        </div>
                        <div class="marca-stat">
                            <span>{{ $stat->total ?? 0 }} kit(s)</span>
                            <span>{{ $stat->ativos ?? 0 }} ativo(s)</span>
                        </div>
                        <div class="marca-actions">
                            <a class="btn-marca-edit" href="{{ route('admin.produtos.inversores.edit', $item->id) }}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center mb-0">
                    <i class="fas fa-info-circle"></i> Nenhuma marca de inversor cadastrada.
                </div>
            @endforelse
        </div>
    </x-body>
</x-layout>
