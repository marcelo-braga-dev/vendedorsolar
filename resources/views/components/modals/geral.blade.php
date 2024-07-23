@if(session('sucesso'))
    @push('js')
        {{--https://sweetalert2.github.io/--}}
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                showCloseButton: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('sucesso') }}'
            })
        </script>
    @endpush
@endif
@if(session('erro'))
    @push('js')
        <script>
            Swal.fire(
                'Atenção!',
                '{{ session('erro') }}',
                'error'
            )
        </script>
    @endpush
@endif
