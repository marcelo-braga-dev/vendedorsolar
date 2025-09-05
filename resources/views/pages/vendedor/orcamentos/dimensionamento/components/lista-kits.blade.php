

{{-- ====== LISTA ====== --}}
<div class="d-flex flex-column kit-stack">

    @forelse ($kits as $item)
        <div class="kit-card">
            {{-- Cabeçalho: potência total + logos --}}
            <div class="kit-head">
                <div class="left">
        <span class="badge-total">
          <i class="bi bi-battery-charging"></i>
          Potência total dos kits:
          <strong>{{ convert_float_money($item['potencia']) }} kWp</strong>
        </span>
                </div>
                <div class="brand-logos">
                        <?php if (!empty($produtos[$item['inversor']]['logo'])) : ?>
                    <img src="{{ asset('storage') . '/' . $produtos[$item['inversor']]['logo'] }}" alt="Logo inversor">
                    <?php endif; ?>
                        <?php if (!empty($produtos[$item['painel']]['logo'])) : ?>
                            <img src="{{ asset('storage') . '/' . $produtos[$item['painel']]['logo'] }}" alt="Logo painel">
                        <?php endif; ?>
                </div>
            </div>

            {{-- Cada kit --}}
            @foreach ($item['kits'] as $kit)
                <div class="kit-row">
                    <div class="kit-grid">

                        <div class="kit-main">
                            {{-- badges --}}
                            <div class="kit-badges">
                                @if ($kit['trafo'])
                                    <span class="chip"><i class="bi bi-lightning-charge-fill me-1"></i> Transformador incluso</span>
                                @endif
                                @if(!empty($kit['modelo_trafo']))
                                    <span class="chip"><i class="bi bi-tools me-1"></i> {{ $kit['modelo_trafo'] }}</span>
                                @endif
                            </div>

                            {{-- título --}}
                            <div class="kit-title">{{ $item['qtdKits'] }}x {{ $kit['modelo'] }}</div>
                            <div class="kit-sub">[ID #{{ $kit['id'] }}]</div>

                            {{-- meta --}}
                            <div class="kit-meta mt-2">
                                <div class="item">
                                    <small>Potência total do kit</small>
                                    <i class="bi bi-sun me-1 text-warning"></i>
                                    <strong>{{ convert_float_money($item['potencia']) }} kWp</strong>
                                </div>
                                <div class="item">
                                    <small>Geração Estimada</small>
                                    <i class="bi bi-graph-up-arrow me-1 text-success"></i>
                                    <strong>{{ convert_float_money($item['geracao'], 0) }} kWh</strong>
                                </div>
                                <div class="item">
                                    <small>Inversor</small>
                                    <i class="bi bi-cpu me-1 text-primary"></i>
                                    {{ $produtos[$item['inversor']]['nome'] }}
                                </div>
                                <div class="item">
                                    <small>Painel</small>
                                    <i class="bi bi-grid-1x2 me-1 text-primary"></i>
                                    {{ $produtos[$item['painel']]['nome'] }} {{ $kit['potencia_painel'] }} W
                                </div>
                            </div>
                        </div>

                        <div class="kit-aside">
                            {{-- preços --}}
                            <div class="w-100 text-end">
                                @if(!empty($kit['preco_trafo']))
                                    <div class="small text-muted">Kits: R$ {{ convert_float_money($kit['preco'] - $kit['preco_trafo']) }}</div>
                                    <div class="small text-muted mb-1">Transformador: R$ {{ convert_float_money($kit['preco_trafo']) }}</div>
                                @endif
                                <div class="price"><small>Total</small> R$ {{ convert_float_money($kit['preco']) }}</div>
                            </div>

                            {{-- CTA --}}
                            <form method="POST" action="{{ route('vendedor.dimensionamento.convencional.store') }}" class="w-100">
                                @csrf
                                <input type="hidden" name="consumo" value="{{ $request->consumo ?? 0 }}">
                                <input type="hidden" name="consumo_ponta" value="{{ $request->consumo_ponta }}">
                                <input type="hidden" name="consumo_fora_ponta" value="{{ $request->consumo_fora_ponta }}">
                                <input type="hidden" name="demanda" value="{{ $request->demanda }}">
                                <input type="hidden" name="id_kit" value="{{ $kit['id'] }}">
                                <input type="hidden" name="preco" value="{{ $kit['preco'] }}">
                                <input type="hidden" name="cidade" value="{{ $request->cidade }}">
                                <input type="hidden" name="estrutura" value="{{ $request->estrutura }}">
                                <input type="hidden" name="tensao" value="{{ $request->tensao }}">
                                <input type="hidden" name="orientacao" value="{{ $request->orientacao }}">
                                <input type="hidden" name="cliente" value="{{ $request->cliente }}">
                                <input type="hidden" name="geracao" value="{{ $item['geracao'] }}">
                                <input type="hidden" name="trafo" value="{{ $kit['trafo'] }}">
                                <input type="hidden" name="qtd_kits" value="{{ $item['qtdKits'] }}">

                                <button type="submit" class="btn-cta">
                                    <i class="bi bi-check2-circle"></i> Escolher esse kit
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="alert alert-info text-center">Não foi encontrado kits para esse dimensionamento.</div>
    @endforelse

</div>
