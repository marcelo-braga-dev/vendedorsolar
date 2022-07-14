<div class="container-fluid mt--7 mb-6 px-2">
    <div class="card shadow mt-5">
        <div class="card-header border-bottom">
            <div class="row align-items-center">
                <div class="col-12 col-md-auto">
                    <h3 class="mb-0">{{ $title }}</h3>
                </div>
                <div class="col text-right">
                    @if (!empty($urlButton))
                        <a href="{{ $urlButton }}" class="btn btn-sm btn-primary">
                            @if($textButton) {{$textButton}} @else Voltar @endif
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body p-3 {{ $class }}" {{ $attributes }}>
            {{ $slot }}
        </div>
    </div>
</div>
