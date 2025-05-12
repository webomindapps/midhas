<x-frontend.page>

    <x-slot:title>Midhas-Furniture</x-slot:title>
    <x-slot:meta_items>
        <meta name="description"
            content="Midhas Is An Authorized Dealer And All Products Are Covered By Full Manufacturer's Warranty. Midhas Has Been A Well Known Name For Furniture Matress Business  Since Many Years. Midhas Only Sells Brand New Factory Sealed Products. We Never Sell Refurbished, Used, Or Out-Of-Box Unit. All Of Our Products Come With One Year Parts And Labour Warranty From Manufacturers.">
        <meta name="keywords" content="Midhas">
    </x-slot:meta_items>

    {{-- content  --}}
    @include('frontend.sections.banners')
    @include('frontend.sections.arrivals')
    @include('frontend.sections.shop-byroom')
    @include('frontend.sections.best-sellers')
    @include('frontend.sections.brands')
    @include('frontend.sections.offers')
    @include('frontend.sections.blogs')


    <x-slot:scripts>
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
    </x-slot:scripts>
</x-frontend.page>
