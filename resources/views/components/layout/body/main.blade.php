<div class="container-fluid mt--7">
    <div class="card shadow mt-5">
        <div class="card-header border-bottom">
            <div class="row align-items-center">
                <div class="col-12 col-md-auto">
                    <h3 class="mb-0">{{ $title }}</h3>
                </div>
                <div class="col text-right">
                    @if (!empty($urlButton))
                    <a href="{{ $urlButton }}" class="btn btn-sm btn-primary">
                        Voltar
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>