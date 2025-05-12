<main class="wrapper">
    @if (session('message'))
        <script>
            // toastr.success('{{ session('message') }}')
            window.FlashMessage.info('{{ session('message') }}', {
                timeout: 5000,
                progress: true
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            // toastr.error('{{ session('error') }}')
            window.FlashMessage.error('{{ session('error') }}', {
                timeout: 2000,
                progress: true
            });
        </script>
    @endif
    {{ $slot }}

</main>
