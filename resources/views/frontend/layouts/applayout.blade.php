<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Midha's - Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="{{ asset('frontend/flash.min.css') }}" rel="stylesheet">

    @stack('css')
</head>

<body>
    @include('frontend.layouts.header')
    <div class="main">
        @yield('main-content')
    </div>
    @include('frontend.layouts.footer')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS and Popper.js (required for dropdowns, tooltips, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend/flash.min.js') }}"></script>
    <script src="{{ asset('frontend/js/cart.js') }}"></script>

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
    </script>

    @if (session('message'))
        <script>
            // toastr.success('{{ session('message') }}')
            window.FlashMessage.info('{{ session('message') }}', {
                timeout: 2000,
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

    <script>
        $(function() {
            $('.color_selector').each(function(index, element) {
                $(element).find('span').click(function() {
                    $(element).find('span').removeClass('active');
                    $(this).addClass('active');
                });
            });

            function checkDesktop() {
                return window.innerWidth < 990;
            }
            if (checkDesktop()) {
                $('#search_collapse').removeClass('show');
            }
            //        --------------------------------------------------------------

            // Initialize Blog Swiper
            const swiper2 = new Swiper('.M_blogs', {
                loop: false, // Enable loop
                slidesPerView: 1, // Default slides per view
                spaceBetween: 10, // Space between slides

                // Breakpoints configuration
                breakpoints: {
                    // When window width is >= 640px
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // When window width is >= 768px
                    991: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    // When window width is >= 1024px
                    1280: {
                        slidesPerView: 4,
                        spaceBetween: 40
                    }
                },

                // Pagination
                pagination: {
                    el: '.swiper-pagination', // Target pagination element
                    clickable: true, // Allow clicking on the pagination bullets
                }

            });

            //        --------------------------------------------------------------
            // Initialize Swiper
            const swiper1 = new Swiper('.M_products', {
                loop: false, // Enable loop
                slidesPerView: 1, // Default slides per view
                spaceBetween: 0, // Space between slides

                // Breakpoints configuration
                breakpoints: {
                    // When window width is >= 640px
                    360: {
                        slidesPerView: 2
                    },
                    // When window width is >= 991px
                    991: {
                        slidesPerView: 3
                    },
                    // When window width is >= 1024px
                    1200: {
                        slidesPerView: 4
                    },
                    // When window width is >= 1024px
                    1440: {
                        slidesPerView: 5
                    }
                },

                // Custom navigation
                navigation: {
                    nextEl: '.product-swiper-button-next', // Custom next button class
                    prevEl: '.product-swiper-button-prev' // Custom previous button class
                }
            });


            // Disable navigation arrows when at the beginning or end
            swiper1.on('slideChange', function() {
                const prevButton = document.querySelector('.product-swiper-button-prev');
                const nextButton = document.querySelector('.product-swiper-button-next');

                // Disable "Previous" button if at the beginning
                if (swiper1.isBeginning) {
                    prevButton.classList.add('swiper-button-disabled');
                } else {
                    prevButton.classList.remove('swiper-button-disabled');
                }

                // Disable "Next" button if at the end
                if (swiper1.isEnd) {
                    nextButton.classList.add('swiper-button-disabled');
                } else {
                    nextButton.classList.remove('swiper-button-disabled');
                }
            });

            // Initialize the arrow states when the page loads
            if (swiper1.isBeginning) {
                document.querySelector('.product-swiper-button-prev').classList.add('swiper-button-disabled');
            }

            if (swiper1.isEnd) {
                document.querySelector('.product-swiper-button-next').classList.add('swiper-button-disabled');
            }


        });
    </script>
</body>

</html>
