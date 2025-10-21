<x-layout menu="contratos" submenu="contratos-gerados">
    @push('css')
        <style>
            .card-soft {
                border: 1px solid #eef2f6;
                border-radius: 16px;
                box-shadow: 0 8px 26px rgba(0, 0, 0, .04);
                background: #fff;
            }

            .btn-brand {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                background: var(--red);
                border-color: var(--red);
                color: #fff;
                font-weight: 700;
                border-radius: 12px;
            }

            .btn-brand:hover {
                background: var(--brand-600);
                border-color: var(--brand-600);
                color: #fff;
            }

            .bi {
                line-height: 0;
                font-size: 25px;
                transform: translateY(-.5px);
            }
        </style>
    @endpush

    <x-layout.container title="" class="p-0">
        <div class="card-soft p-3 p-md-4 mb-3">
            <div class="header-wrap">
                <div class="d-flex gap-2">
                    <button id="btnGerarPdf"
                            class="btn btn-brand d-inline-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <span class="label">Abrir PDF</span>
                    </button>
                </div>
            </div>
        </div>
    </x-layout.container>

    <x-layout.container title="Contrato" class="p-0">
        <div class="card-soft p-3 p-md-4 mb-3">
            <div class="header-wrap">
                <div>
                    <h2 style="text-align: center; margin-bottom: 30px">CONTRATO DE COMPRA E VENDA DE SISTEMA DE ENERGIA SOLAR</h2>
                    <p>
                        Pelo presente instrumento particular, as partes abaixo qualificadas:
                    </p>
                    <p>
                        Vendedora: <strong>SOLMAR ENERGIA SOLAR</strong>, com sede à Av. Mandacarú, nº 4943, telefone (44) 99990-3092, inscrita no CNPJ sob nº
                        27.908.036/0001-24,
                        doravante denominada
                        simplesmente <strong>VENDEDORA</strong>;
                    </p>
                    <p>
                        Comprador: <strong>{{$contrato->nome_cliente}}</strong>, CPF/CNPJ nº {{$contrato->documento_cliente}}, residente/endereço
                        {{$contrato->endereco}}, doravante denominado <strong>COMPRADOR</strong>;
                    </p>
                    <p>
                        Têm entre si justo e contratado o que segue:
                    </p>
                    <p>
                        <strong>1. OBJETO:</strong> O presente contrato tem por objeto a venda e instalação de um sistema de geração de energia solar fotovoltaico, conforme
                        proposta
                        comercial aprovada pelo COMPRADOR.
                    </p>
                    <p>
                        <strong>2. PRAZO DE ENTREGA:</strong> A VENDEDORA compromete-se a realizar a entrega e instalação do sistema no prazo acordado entre as partes,
                        contado a
                        partir da assinatura deste contrato e do pagamento inicial.
                    </p>
                    <p>
                        <strong>3. GARANTIA:</strong> Os equipamentos fornecidos possuem garantia de fábrica de acordo com o fabricante, e a instalação possui garantia de 12
                        (doze)
                        meses contra defeitos de execução.
                    </p>
                    <p>
                        <strong>4. PAGAMENTO:</strong> O valor total e as condições de pagamento serão conforme a proposta comercial aceita pelo COMPRADOR.
                    </p>
                    <p>
                        <strong>5. RESPONSABILIDADES:</strong> A VENDEDORA responsabiliza-se pela instalação correta e funcionamento do sistema, observando as normas técnicas
                        aplicáveis. O COMPRADOR deverá garantir o acesso ao local e as condições adequadas para execução dos serviços.
                    </p>
                    <p>
                        <strong>6. DISPOSIÇÕES GERAIS:</strong> Este contrato passa a vigorar a partir da data de sua assinatura. Os casos omissos serão resolvidos de comum
                        acordo
                        entre as partes.
                    </p>
                    <p style="margin-top: 30px">
                        E por estarem de acordo, assinam o presente contrato em duas vias de igual teor e forma.
                    </p>
                    <div style="margin-top: 50px; text-align: center">
                        <p>
                            Maringá, {{($contrato->contrato_data)}}.
                        </p>
                    </div>

                    <table style="width: 100%; margin-top: 120px; margin-bottom: 50px">
                        <tbody>
                        <tr>
                            <td style="text-align: center; max-width: 50%">
                                ______________________________________________________<br/>
                                <strong>SOLMAR ENERGIA SOLAR</strong><br/>
                                CNPJ: 27.908.036/0001-24
                            </td>
                            <td style=" text-align: center; width: 50%">
                                ______________________________________________________<br/>
                                <strong>COMPRADOR</strong><br/>
                                CPF/CNPJ: {{$contrato->documento_cliente}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-layout.container>


    @push('js')
        <script>
            (function () {
                const btn = document.getElementById('btnGerarPdf');

                async function generatePdf() {
                    // estado de carregando
                    const original = btn.innerHTML;
                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Gerando PDF...';

                    const payload = {id: {{ $contrato->id }}};

                    try {
                        const response = await fetch("{{ route('vendedor.contratos.pdf') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify(payload)
                        });

                        if (!response.ok) {
                            console.info(response);
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
                        a.setAttribute('download', "{{ ($contrato->nome_cliente) }}_{{ $contrato->id }}.pdf");
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                    } catch (error) {
                        console.error(error);
                        // feedback simples (você pode trocar por um toast do seu tema)
                        // alert('Não foi possível gerar o PDF agora. Tente novamente em instantes.');
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


