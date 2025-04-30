<x-app-layout>
    @section('main-content')
        <section class="section breadcrumb pb-0 seo_content w-100">
            <div class="container text-start">
                <ul class="list_styled d-flex breadcrumb mb-5">
                    <li><a href="">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                    <li>{{ $product->title }}</li>
                </ul>
            </div>
        </section>


        <section class="section detail_wrapper w-100">
            <div class="container text-start">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="left_sticky">
                                <!-- Slider main wrapper -->
                                <div class="swiper-container-wrapper">
                                    <!-- Slider thumbnail container -->
                                    <div class="thumb_with_navs position-relative">
                                        <div class="swiper-container gallery-thumbs">
                                            <!-- Additional required wrapper -->
                                            <div class="swiper-wrapper">
                                                <!-- Slides -->
                                                @foreach ($product->images as $image)
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset($image->url) }}" alt=""
                                                            class="w-100 img-fluid">
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <!-- Add Arrows -->
                                        <div class="swiper-Tbutton-next position-absolute text-center bottom-0 w-100"><i
                                                class="fa-solid fa-chevron-down"></i></div>
                                        <div class="swiper-Tbutton-prev position-absolute text-center top-0 w-100"><i
                                                class="fa-solid fa-chevron-up"></i></div>
                                    </div>
                                    <!-- Slider main container -->
                                    <div class="swiper-container gallery-top">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- Slides -->
                                            @foreach ($product->images as $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset($image->url) }}" alt=""
                                                        class="w-100 img-fluid">
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Add Arrows -->
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>

                                <div class="share_icons text_inter">
                                    <p>Code: COFOR cortz coffee Table</p>
                                    <div class="share_on d-flex align-items-center text-uppercase fw-bold">
                                        <h3 class="mb-0">Share</h3>
                                        <ul class="d-flex list_styled">
                                            <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                                            <li><a href=""><i class="fa-brands fa-whatsapp"></i></a></li>
                                            <li><a href=""><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="product_info text_inter">
                                <h2 class="prod_title fw-bold text_hind">{{ $product->title }}</h2>
                                <p class="mb-0 prod_price text-uppercase text_inter">From <span>${{ $product->msrp }}</span>
                                </p>
                                <div class="payment d-flex align-items-center"><img src="images/PayPal.webp" alt=""
                                        class="img-fluid"> Pay in 3 interest payment of $ 18.33</div>
                                <div class="stock d-flex align-items-center"><span class="text_orange">In Stock</span>
                                    &nbsp;|&nbsp; <span>Usually dispatched within 24 hours</span></div>
                                <div class="product_options mt-4 col-md-6 col-12">
                                    <select class="form-select rounded-0" id="exampleSelect" aria-label="Select an option">
                                        <option selected>Choose an option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>

                                    <p class="d-block w-100 mt-4">Pick a color: </p>
                                    <div class="color_selector d-flex justify-content-start">
                                        <span class="active" style="--color:#B3B3B3"></span>
                                        <span class="" style="--color:#252831"></span>
                                        <span class="" style="--color:#7b6244"></span>
                                        <span class="" style="--color:#2a5027"></span>
                                    </div>

                                </div>
                                <div class="d-flex align-items-center detail-addtocart">
                                    <div class="number d-flex align-items-center ">
                                        <p class="d-inline mb-0 me-2 fw-bold">Qty</p>
                                        {{-- <div class="input-group">
                                            <input type="button" value="-" data-field="quantity"
                                                class="button-minus"> <input type="text" step="1" max=""
                                                value="1" name="quantity" class="quantity-field"> <input type="button"
                                                value="+" data-field="quantity" class="button-plus">
                                        </div> --}}
                                        <x-qty-input :id="$product->id" />
                                    </div>
                                    <!--                                <div class="clearflix"></div>-->
                                    <div class="add-cart d-block text-center text-uppercase fw-bold">
                                        <a class="addToCart d-block w-100" data-id="{{ $product->id }}"> Add to cart </a>
                                    </div>
                                </div>
                                <a href="" class="add_wishlist d-block w-100 text-uppercase text-center"> <i
                                        class="fa-solid fa-heart me-2"></i> Add to wishlist</a>
                                <div class="d-flex align-items-center other_actions">
                                    <button class="btn text-uppercase">ask a question</button>
                                    <button class="btn text-uppercase">Tell a friend</button>
                                    <button class="btn text-uppercase">add to compare</button>
                                </div>
                                <div class="d-block w-100 more_actions">
                                    <button class="btn d-block w-100 text-uppercase">View all cortez</button>
                                    <button class="btn d-block w-100 text-uppercase">View all living room</button>
                                    <button class="btn d-block w-100 text-uppercase">View all coffee tables</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section prd_info w-100 text_inter">
            <div class="container text-start">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-details-tab" data-bs-toggle="pill" href="#pills-details"
                            role="tab" aria-controls="pills-details" aria-selected="true">Product Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-specs-tab" data-bs-toggle="pill" href="#pills-specs"
                            role="tab" aria-controls="pills-specs" aria-selected="false">PRODUCT SPECIFICATIONS</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-despcription-tab" data-bs-toggle="pill" href="#pills-despcription"
                            role="tab" aria-controls="pills-despcription" aria-selected="false">PRODUCT
                            DESCRIPTION</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-instructions-tab" data-bs-toggle="pill" href="#pills-instructions"
                            role="tab" aria-controls="pills-instructions" aria-selected="false">ASSEMBLY
                            INSTRUCTION</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-payment-tab" data-bs-toggle="pill" href="#pills-payment"
                            role="tab" aria-controls="pills-payment" aria-selected="false">PAYMENT SECURITY</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-details" role="tabpanel"
                        aria-labelledby="pills-details-tab">
                        <ul>
                            <li>Size = (W) 82cm (D) 34cm (H) 90cm</li>
                            <li>Range of Colours Available</li>
                            <li>Aluminium Handle</li>
                            <li>Compact Design</li>
                            <li>Space Saving Storage</li>
                            <li>Flat Packed for Home Assembly</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-specs" role="tabpanel" aria-labelledby="pills-specs-tab">
                        <div class="site-title text-center text-uppercase">Shoe Cabinet</div>
                        <table class="vertical-table">
                            <tbody>
                                <tr>
                                    <th>
                                        Assembly Required
                                    </th>
                                    <td data-th="Assembly Required">Yes</td>
                                </tr>
                                <tr>
                                    <th>
                                        Dimensions
                                    </th>
                                    <td data-th="Dimensions">(W) 82cm (D) 34cm (H) 90cm</td>
                                </tr>
                                <tr>
                                    <th>
                                        Main Material
                                    </th>
                                    <td data-th="Main Material">MDF</td>
                                </tr>
                                <tr>
                                    <th>
                                        Number of Drawers
                                    </th>
                                    <td data-th="Number of Drawers">1</td>
                                </tr>
                                <tr>
                                    <th>
                                        Number of Doors
                                    </th>
                                    <td data-th="Number of Doors">2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pills-despcription" role="tabpanel"
                        aria-labelledby="pills-despcription-tab">
                        <p>The Novara shoe storage cabinet is the ideal addition to any entryway, hallways and even your
                            bedroom! Crafted using particle board and MDF, making the shoe cabinet durable and lightweight
                            that’s easy to assemble and move around your home.&nbsp;</p>
                        <p>Available in a range of colours, the Novara cabinet allows you to choose the perfect colour to
                            complement your home décor, whether you prefer subtle neutrals or bold statements, it’s an
                            affordable storage solution for those looking to tidy up their homes without breaking the bank.
                            Whether you're a first-time buyer or updating your space on a budget, the Novara cabinet is
                            excellent value for money.</p>
                        <p>Say goodbye to cluttered floors and disorganised shoe piles, and enjoy a more tidy, organised
                            space with this shoe storage cabinet.</p>
                    </div>
                    <div class="tab-pane fade" id="pills-instructions" role="tabpanel"
                        aria-labelledby="pills-instructions-tab">
                        <p class="text_inter mb-0">Create a relaxing and inviting atmosphere with our stylish, affordable
                            living room furniture selection. Whether you want to create a fun, entertaining space with
                            sociable seating and the perfect TV stand for film nights or a relaxation retreat with lamp
                            tables for soft lighting and for your cuppa, there’s something for everyone at Big Furniture
                            Warehouse. Create a modern, clean aesthetic with white and grey lounge furniture or a more
                            rustic feel with natural wood furniture and bring your vision to life.</p>
                    </div>
                    <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                        <p class=""><strong>Payment</strong></p>
                        <p class="">We have plenty of payment options available to use! Including;</p>
                        <ul>
                            <li>G Pay</li>
                            <li>Apple Pay</li>
                            <li>Credit/Debit Card</li>
                            <li>Paypal</li>
                            <li>Amazon Pay</li>
                        </ul>
                        <p>We also have finance options if you would prefer to split your payments;</p>
                        <ul>
                            <li>Paypal Pay in 3</li>
                            <li>Clearpay</li>
                            <li>Klarna</li>
                        </ul>
                        <p><em>* Borrowing more than you can afford or paying late may negatively impact your financial
                                status and ability to obtain credit. *</em></p>
                        <p class=""><strong>Security</strong></p>
                        <p class="">When you shop with us, be confident knowing that our payment provider, Stripe,
                            has the most stringent level of certification available in the payments industry. To accomplish
                            this, Stripe uses the best-in-class security tools and practices to maintain a high level of
                            security.</p>
                        <p class="">All card numbers are encrypted at rest with AES-256. Decryption keys are stored
                            on separate machines. None of Stripe’s internal servers and daemons can obtain plain text card
                            numbers but can request that cards are sent to a service provider on a static allow list.
                            Stripe’s infrastructure for storing, decrypting, and transmitting card numbers runs in a
                            separate hosting environment, and doesn’t share any credentials with Stripe’s primary services
                            including our API and website.</p>

                    </div>
                </div>
            </div>
        </section>


        <section class="section sellers bg-light">
            <div class="container text-center">
                <h2 class="sec_title text_inter text-uppercase fw-normal">you may <span class="fw-bold">also like</span>
                </h2>

                <div class="col-12 mt-5 swiper-container M_products">
                    <div class="product_wrap swiper-wrapper">
                        @foreach ($recentViewed as $recents)
                            <div class="swiper-slide">
                                <x-product-card :product="$recents" />
                            </div>
                        @endforeach
                    </div>
                    <!-- Custom Navigation buttons -->
                    <div class="product-swiper-button-next"><i class="fa-solid fa-arrow-right"></i></div>
                    <div class="product-swiper-button-prev"><i class="fa-solid fa-arrow-left"></i></div>
                </div>
            </div>
        </section>
    @endsection
    @push('scripts')
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
                // Initialize Swiper
                const swiper = new Swiper('.M_products', {
                    loop: false, // Enable loop
                    slidesPerView: 1, // Default slides per view
                    spaceBetween: 10, // Space between slides

                    // Breakpoints configuration
                    breakpoints: {
                        // When window width is >= 640px
                        360: {
                            slidesPerView: 2,
                            spaceBetween: 0
                        },
                        // When window width is >= 768px
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 5
                        },
                        // When window width is >= 1024px
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 5
                        },
                        // When window width is >= 1024px
                        1440: {
                            slidesPerView: 5,
                            spaceBetween: 0
                        }
                    },

                    // Custom navigation
                    navigation: {
                        nextEl: '.product-swiper-button-next', // Custom next button class
                        prevEl: '.product-swiper-button-prev' // Custom previous button class
                    }
                });


                // Disable navigation arrows when at the beginning or end
                swiper.on('slideChange', function() {
                    const prevButton = document.querySelector('.product-swiper-button-prev');
                    const nextButton = document.querySelector('.product-swiper-button-next');

                    // Disable "Previous" button if at the beginning
                    if (swiper.isBeginning) {
                        prevButton.classList.add('swiper-button-disabled');
                    } else {
                        prevButton.classList.remove('swiper-button-disabled');
                    }

                    // Disable "Next" button if at the end
                    if (swiper.isEnd) {
                        nextButton.classList.add('swiper-button-disabled');
                    } else {
                        nextButton.classList.remove('swiper-button-disabled');
                    }
                });

                // Initialize the arrow states when the page loads
                if (swiper.isBeginning) {
                    document.querySelector('.product-swiper-button-prev').classList.add('swiper-button-disabled');
                }

                if (swiper.isEnd) {
                    document.querySelector('.product-swiper-button-next').classList.add('swiper-button-disabled');
                }
                //        --------------------------------------------------------------

                var galleryThumbs = new Swiper(".gallery-thumbs", {
                    centeredSlides: true,
                    centeredSlidesBounds: true,
                    direction: "horizontal",
                    spaceBetween: 15,
                    slidesPerView: 3,
                    navigation: {
                        nextEl: ".swiper-Tbutton-next",
                        prevEl: ".swiper-Tbutton-prev"
                    },
                    freeMode: false,
                    watchSlidesVisibility: true,
                    watchSlidesProgress: true,
                    watchOverflow: true,
                    breakpoints: {
                        680: {
                            direction: "vertical",
                            slidesPerView: 3
                        }
                    }
                });
                var galleryTop = new Swiper(".gallery-top", {
                    direction: "horizontal",
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev"
                    },
                    a11y: {
                        prevSlideMessage: "Previous slide",
                        nextSlideMessage: "Next slide",
                    },
                    keyboard: {
                        enabled: true,
                    },
                    thumbs: {
                        swiper: galleryThumbs
                    }
                });

                galleryTop.on("slideChangeTransitionStart", function() {
                    galleryThumbs.slideTo(galleryTop.activeIndex);
                });
                galleryThumbs.on("transitionStart", function() {
                    galleryTop.slideTo(galleryThumbs.activeIndex);
                });

                //        --------------------------------------------------------------

                $('.input-group').on('click', '.button-plus', function(e) {
                    incrementValue(e);
                });

                $('.input-group').on('click', '.button-minus', function(e) {
                    decrementValue(e);
                });

                function incrementValue(e) {
                    e.preventDefault();
                    var fieldName = $(e.target).data('field');
                    var parent = $(e.target).closest('div');
                    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                    if (!isNaN(currentVal)) {
                        parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                    } else {
                        parent.find('input[name=' + fieldName + ']').val(0);
                    }
                }

                function decrementValue(e) {
                    e.preventDefault();
                    var fieldName = $(e.target).data('field');
                    var parent = $(e.target).closest('div');
                    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                    if (!isNaN(currentVal) && currentVal > 0) {
                        parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                    } else {
                        parent.find('input[name=' + fieldName + ']').val(0);
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
