<x-frontend.page>



    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.color_selector .product_variant').on('click', function() {
                    var variantId = $(this).data('variant-id');
                    $('.addToCart').data('variant', variantId);
                });
            });
        </script>
    @endpush
    <section class="section breadcrumb pb-0 seo_content w-100">
        <div class="container text-start">
            <ul class="list_styled d-flex breadcrumb mb-5">
                <li><a href="">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                <li>{{ $product->title }}</li>
            </ul>
        </div>
    </section>

    <input type="hidden" value="{{ $product->id }}" id="product_id">
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
                                    class="img-fluid"><strong> SKU:{{ $product->sku }}</strong></div>
                            <div class="stock d-flex align-items-center"><span class="text_orange">
                                    @if ($product->is_outof_stock == 1)
                                        Out Of Stock
                                    @else
                                        InStock
                                    @endif
                                </span>
                                &nbsp;|&nbsp; <span>Usually dispatched within 24 hours</span></div>
                            <div class="product_options mt-4 col-md-6 col-12">

                                <p class="d-block w-100 mt-4">Pick a color: </p>


                                <div class="color_selector d-flex justify-content-start">
                                    @foreach ($product->variants as $variant)
                                        <span class="product_variant" style="--color:{{ $variant->value }};"
                                            data-variant-id="{{ $variant->id }}">
                                        </span>
                                    @endforeach
                                </div>

                            </div>
                            @if ($product->isEnquiry())
                                <div class=" d-block text-center text-uppercase fw-bold">
                                    <a class=" add_wishlist bg-danger text-white d-block w-100" data-bs-toggle="modal"
                                        data-bs-target="#sendEnquiry">
                                        Send Enquiry
                                    </a>
                                </div>

                                <div class="modal fade" id="sendEnquiry" tabindex="-1"
                                    aria-labelledby="sendEnquiryLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Send Enquiry</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('product.enquiry', ['product' => $product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputName" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="exampleInputName" value="{{ auth()->user()?->name }}"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPhone" class="form-label">Phone</label>
                                                        <input type="text" class="form-control" name="phone"
                                                            id="exampleInputPhone" value="" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputMessage"
                                                            class="form-label">Message</label>
                                                        <textarea name="message" class="form-control" id="exampleInputMessage" cols="30" rows="10" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center detail-addtocart mb-4">
                                    <div class="number d-flex align-items-center ">
                                        <p class="d-inline mb-0 me-2 fw-bold">Qty</p>

                                        <x-qty-input :id="$product->id" />
                                    </div>
                                    <div class="add-cart d-block text-center text-uppercase fw-bold">

                                        @if ($product->total_stock > 0 && !$product->is_outof_stock)
                                            <a class="addToCart d-block w-100" data-id="{{ $product->id }}"> Add to
                                                cart
                                            </a>
                                        @else
                                            <p class="stock-out">
                                                <a class=" bg-danger text-white d-block w-100"
                                                    data-id="{{ $product->id }}">
                                                    Out Of Stock
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @php
                                $isWishlisted = $product->isAddedToWishList();
                            @endphp

                            <a href="javascript:void(0);"
                                class="add_wishlist addToWishList d-block w-100 text-uppercase text-center {{ $isWishlisted ? 'active' : '' }}"
                                data-product-id="{{ $product->id }}">

                                <i class="fa{{ $isWishlisted ? 's' : 'r' }} fa-heart me-2 wishlist-icon"
                                    style="color: {{ $isWishlisted ? 'red' : '#ccc' }}"></i>

                                <span class="wishlist-text">
                                    {{ $isWishlisted ? 'Remove from wishlist' : 'Add to wishlist' }}
                                </span>
                            </a>
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
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-review-tab" data-bs-toggle="pill" href="#pills-review"
                        role="tab" aria-controls="pills-review" aria-selected="false">REVIEWS</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-finance-tab" data-bs-toggle="pill" href="#pills-finance"
                        role="tab" aria-controls="pills-finance" aria-selected="false">FINANCING</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-details" role="tabpanel"
                    aria-labelledby="pills-details-tab">
                    <ul>
                        @foreach (explode("\n", $product->product_details) as $detail)
                            @if (trim($detail) != '')
                                <li>{{ $detail }}</li>
                            @endif
                        @endforeach
                    </ul>

                </div>
                <div class="tab-pane fade" id="pills-specs" role="tabpanel" aria-labelledby="pills-specs-tab">
                    <div class="site-title text-center text-uppercase">Shoe Cabinet</div>
                    <table class="vertical-table">
                        <tbody>
                            @foreach ($product->specifications as $specs)
                                <tr>
                                    <th>{{ $specs->specs->name }}</th>
                                    <td data-th="assembly">{{ $specs->value }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-despcription" role="tabpanel"
                    aria-labelledby="pills-despcription-tab">
                    <p>{{ $product->product_description }}</p>
                </div>
                <div class="tab-pane fade" id="pills-instructions" role="tabpanel"
                    aria-labelledby="pills-instructions-tab">
                    @foreach ($product->manuals as $manual)
                        <a href="{{ asset('storage/' . $manual->uploaded_file) }}" target="_blank"
                            contenteditable="false" style="cursor: pointer;">
                            <img src="{{ asset('frontend/images/pdf-icon.webp') }}" border="0" alt="PDF"
                                style="height:15px; width:15px">
                            {{ $manual->name }} </a>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                    <p class=""><strong>Payment</strong></p>
                    <ul>
                        @foreach (explode("\n", $product->payment_security) as $method)
                            @if (trim($method))
                                <li>{{ trim($method) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                    {{-- <p class=""><strong>Review</strong></p> --}}
                    <ul>
                        <x-frontend.review.section :product="$product">
                            @auth
                                <x-frontend.review.create :product="$product" />
                            @endauth
                        </x-frontend.review.section>
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-finance" role="tabpanel" aria-labelledby="pills-finance-tab">
                    @if (count($product->finances) > 0)
                        <div class="row">
                            <div class="col-lg-9 mx-auto text-center">
                                <div class="fin_wrap">
                                    <!-- Tab Navigation -->
                                    <ul class="nav nav-pills mb-3" id="pills-tab-financing" role="tablist">
                                        @foreach ($product->finances as $index => $finance)
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fin_icon nav-link-finance"
                                                    id="pill-financing-{{ $finance->id }}" data-bs-toggle="pill"
                                                    data-bs-target="#pills-financing-{{ $finance->id }}"
                                                    type="button" role="tab"
                                                    aria-controls="pills-financing-{{ $finance->id }}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ $finance->name }}
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content" id="pills-tabFinancingContent">
                                        @foreach ($product->finances as $finance)
                                            <div class="tab-pane fade" id="pills-financing-{{ $finance->id }}"
                                                role="tabpanel" aria-labelledby="pill-financing-{{ $finance->id }}">
                                                <div class="row border-top border-bottom py-lg-5 py-4">
                                                    <div class="col-lg-4">
                                                        <div class="financing-payment">
                                                            <span>${{ Midhas::formatPrice($finance->pricePerMonth()) }}</span>
                                                            <span>per month</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="financing-payment">
                                                            <span>${{ $finance->interest_per_month }}</span>
                                                            <span>interest</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="financing-payment">
                                                            <span>${{ Midhas::formatPrice($finance->financingPrice()) }}</span>
                                                            <span>financing fee</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-9 mx-auto text-center">
                                Not Available
                            </div>
                        </div>
                    @endif
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
                    @foreach ($relatedProducts as $related)
                        <div class="swiper-slide">
                            <x-product-card :product="$related" />
                        </div>
                    @endforeach
                </div>
                <!-- Custom Navigation buttons -->
                <div class="product-swiper-button-next"><i class="fa-solid fa-arrow-right"></i></div>
                <div class="product-swiper-button-prev"><i class="fa-solid fa-arrow-left"></i></div>
            </div>
        </div>
    </section>
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


            });
        </script>
    </x-slot:scripts>
</x-frontend.page>
