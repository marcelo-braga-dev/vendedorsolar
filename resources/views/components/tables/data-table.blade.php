@push('css')
    <link type="text/css" href="{{ asset('assets/data-table/style.css') }}" rel="stylesheet">
    <style>
        .table-clickable tbody tr td {
            border-bottom: 1px solid #efefef;
        }

        .table-clickable tbody tr,
        .table-clickable thead tr {
            font-size: 14px;
        }

        .table-clickable tbody tr:hover {
            color: black;
            background-color: #fafafa;
        }

        .dataTables_filter label {
            font-size: 14px;
        }

        #DataTables_Table_0_length label {
            display: none;
            font-size: 14px;
        }
    </style>
@endpush
<div class="row hidden-toggle">
    <span class="mx-auto">Carregando...</span>
</div>
<div class="table-responsive">
    <table class="data-table table-clickable table-flush hover hidden-toggle d-none">
        <thead>
        {{ $head }}
        </thead>
        <tbody>
        {{ $body }}
        </tbody>
    </table>
</div>
@push('js')
    <script src="{{ asset('assets/data-table/script.js') }}"></script>
    <script>
        $(function () {
            $('.hidden-toggle').toggleClass('d-none');

            $('.data-table').DataTable({
                "order": [],
                "pageLength": 25,
                "language": {
                    "lengthMenu": "_MENU_ registros por página.",
                    "zeroRecords": "Nenhum registro encontrado",
                    // "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "info": "",
                    "infoEmpty": "Sem registros",
                    "infoFiltered": "",
                    "decimal": ",",
                    "thousands": ".",
                    "first": "Primeira Página",
                    "paginate": {
                        "first": "Primeira",
                        "last": "Última",
                        "next": ">",
                        "previous": "<"
                    },
                    "emptyTable": "Nenhum registro encontrado.",
                    "loadingRecords": "Carregando...",
                    "processing": "Processando...",
                    "search": "Pesquisar:",
                    "aria": {
                        "sortAscending": ": Ordenar colunas de forma ascendente",
                        "sortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    },
                    "buttons": {
                        "copy": "Copiar para a área de transferência",
                        "copyTitle": "Cópia bem sucedida",
                        "copySuccess": {
                            "1": "Uma linha copiada com sucesso",
                            "_": "%d linhas copiadas com sucesso"
                        }
                    },
                    "infoPostFix": ""
                }
            });
        });
    </script>
@endpush
