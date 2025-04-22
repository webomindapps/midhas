<section class="section brands">
    <div class="container text-center">
        <h2 class="sec_title text_inter text-uppercase fw-normal">Our <span class="fw-bold">Brand Partner</span></h2>

        <div class="col-12 mt-sm-5 mt-4 logo_slider d-flex overflow-hidden">
            <div class="lg_slide d-flex">
                @for ($i = 0; $i < 3; $i++)
                    @foreach ($brands as $brand)
                        <img src="{{ asset($brand->image->url ?? '') }}" alt="" class="img-fluid">
                    @endforeach
                @endfor
            </div>
        </div>

    </div>
</section>
