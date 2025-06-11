<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="{{ asset('frontend/flash.min.css') }}" rel="stylesheet">

    @stack('css')
    @vite(['resources/js/frontend.js','resources/js/app.js'])

</head>

<body>
    <x-frontend.header />
    <x-frontend.content>
        @yield('main-content')

    </x-frontend.content>
    <x-frontend.footer />


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS and Popper.js (required for dropdowns, tooltips, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend/flash.min.js') }}"></script>
    <script src="{{ asset('frontend/js/cart.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggles = document.querySelectorAll(".toggle-password");

            toggles.forEach(function(toggle) {
                toggle.addEventListener("click", function() {
                    const input = document.getElementById(this.getAttribute("data-target"));
                    const isPassword = input.getAttribute("type") === "password";

                    input.setAttribute("type", isPassword ? "text" : "password");

                    // Toggle icon class
                    this.classList.toggle("fa-eye");
                    this.classList.toggle("fa-eye-slash");
                });
            });
        });
        var searchTimer;
        $(document).on('input', '#search-input', function() {
            var searchInput = $(this).val().trim();
            if (searchInput.length < 2) {
                $('#searched-item-List').empty();
                $('.search-results').hide();
                return;
            }

            clearTimeout(searchTimer);

            searchTimer = setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('search.products') }}",
                    data: {
                        search: searchInput,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#searched-item-List').html(response.html);
                        $('.search-results').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }, 200);
        });
    </script>
</body>

</html>
