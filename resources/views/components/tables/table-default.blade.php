@props(['paginate' => null])
<div class="table-responsive">
    <table class="table align-items-center table-flush bg-white">
        <thead>
        {{ $head }}
        </thead>
        <tbody class="list">
        {{ $body }}
        </tbody>
    </table>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-auto">
        {{ $paginate }}
    </div>
</div>
