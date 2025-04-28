<section class="section offers">
    <div class="container text-center">
        <div class="col-12">
            <div class="row gx-sm-5 gx-0 gy-3">
                <div class="row gx-sm-5 gx-0 gy-3">
                    @foreach ($banners as $banner)
                        @if ($banner->type == 3)
                            @foreach ($banner->images as $image)
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $image->banner_url ?? '') }}" alt="Banner"
                                        class="w-100 img-fluid">
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



<section class="section best_offers bg-light">
    <div class="container text-center">
        <h2 class="sec_title text_inter text-uppercase fw-normal">our special <span class="fw-bold">Offers</span></h2>

        <div class="col-12 mt-sm-5 mt-2 swiper-container M_products">
            <div class="product_wrap swiper-wrapper">
                @foreach ($specialoffers as $offer)
                    <div class="swiper-slide">
                        <x-product-card :product="$offer" />
                    </div>
                @endforeach

            </div>
            <!-- Custom Navigation buttons -->
            <div class="product-swiper-button-next"><i class="fa-solid fa-arrow-right"></i></div>
            <div class="product-swiper-button-prev"><i class="fa-solid fa-arrow-left"></i></div>
        </div>
    </div>
</section>
