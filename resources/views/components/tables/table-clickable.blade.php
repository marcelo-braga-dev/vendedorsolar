<style>
    .table-clickable tbody tr:hover {
        color: black;
        background-color: #fafafa;
        cursor: pointer;
    }
</style>
@props(['paginate' => null])
<div class="table-responsive">
    <table class="table table-clickable align-items-center table-flush bg-white">
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

@push('js')
    <script>
        $(function () {
            $('.table-clickable tbody tr').click(function () {
                window.location.href = $(this).find('a').attr('href');
            });
        });
    </script>
@endpush
