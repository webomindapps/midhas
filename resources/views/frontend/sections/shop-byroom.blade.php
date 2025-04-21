<section class="section shop_by_room">
    <div class="container text-center">
        <h2 class="sec_title text_inter text-uppercase fw-normal">Shop By <span class="fw-bold">Room</span></h2>

        <div class="col-12 mt-sm-5 mt-4">
            <div class="row gy-4">
                @foreach ($categories->take(5) as $category)
                    <div class="col">
                        <div class="sbr_box">
                            <a href="listing.php">
                                <div class="img-wrapper position-relative">
                                    <img src="{{ asset($category->image->url) }}" alt="" class="img-fluid">
                                    <a href="listing.php" class="dark_btn text-white"> Shop now</a>
                                </div>
                                <h3 class="text_inter text-uppercase fw-normal mt-4">Shop <span
                                        class="fw-bold">{{ $category->name }}</span></h3>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="section offers_CTA d-flex align-items-center justify-content-center">
    <div class="col-lg-6 text-center">
        <h2 class="text_inter text-white text-uppercase">Modern Furniture</h2>
        <a href="#" class="dark_btn text-white "> Shop now</a>
    </div>
</section>
