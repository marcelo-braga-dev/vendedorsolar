<x-layout menu="configs" submenu="backups">
    <x-body title="Backups">

        <div class="row">
            <div class="col-md-3">
                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item mb-3">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-2-tab" data-toggle="tab"
                               href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                               aria-selected="false">
                                <i class="ni ni-cloud-download-95 mr-2"></i>
                                Exportar Dados
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-1-tab" data-toggle="tab"
                               href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                               aria-selected="true">
                                <i class="ni ni-cloud-upload-96 mr-2"></i>
                                Importar Dados
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-icons-text-2" role="tabpanel"
                                 aria-labelledby="tabs-icons-text-2-tab">
                                <form action="{{ route('admin.configs.backup.create') }}">
                                    <p>Selecione os dados a serem exportados:</p>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">
                                            Orçamentos
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">
                                            Leads
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">
                                            Kits Fotovoltaicos
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4">
                                        <label class="custom-control-label" for="customCheck4">
                                            Produtos
                                        </label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck5">
                                        <label class="custom-control-label" for="customCheck5">
                                            Fornecedores
                                        </label>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-auto">
                                            <button class="btn btn-primary">Exportar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-1" role="tabpanel"
                                 aria-labelledby="tabs-icons-text-1-tab">
                                <p>Importação de arquivos</p>
                                <div class="row">
                                    <div class="col-auto mb-3">
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary">Importar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-body>
</x-layout>
