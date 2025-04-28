<section class="section arrivals bg-light">
    <div class="container text-center">
        <h2 class="sec_title text_inter text-uppercase fw-normal">
            New <span class="fw-bold">Arrivals</span>
        </h2>

        <div class="col-12 mt-sm-5 mt-2 swiper-container M_products">
            <div class="product_wrap swiper-wrapper">
                @foreach ($isnew as $product)
                    <div class="swiper-slide">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>

            <!-- Custom Navigation buttons -->
            <div class="product-swiper-button-next"><i class="fa-solid fa-arrow-right"></i></div>
            <div class="product-swiper-button-prev"><i class="fa-solid fa-arrow-left"></i></div>
        </div>
    </div>
</section>
