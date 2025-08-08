<section class="section blog ">
    <div class="container text-start">
        <!--           <h2 class="sec_title text_inter text-uppercase fw-normal">our special <span class="fw-bold">Offers</span></h2>-->

        <div class="col-12 mt-sm-5 mt-0 swiper-container M_blogs">
            <div class="blog_wrap swiper-wrapper">
                @foreach ($blogs as $blog)
                    <div class="swiper-slide">
                        <div class="blog_box">
                            <div class="blg_img">
                                <a href="{{ route('blog.view', $blog->id) }}"><img
                                        src="{{ asset('storage/' . $blog->blog_image) }}" alt=""
                                        class="img-fluid w-100"></a>
                            </div>
                            <div class="blg_content">
                                <h2 class="blog_title text_hind text-uppercase"><a
                                        href="{{ route('blog.view', $blog->id) }}">{{ $blog->blog_title }}</a></h2>
                                <span
                                    class="d-block blog_date text_hind text-uppercase">{{ strtoupper(\Carbon\Carbon::parse($blog->blog_date)->format('M d Y')) }}

                                </span>
                                <p class="blog_excrepts text_inter">
                                    {{ \Illuminate\Support\Str::words($blog->blog_description, 5, '...') }}
                                </p>
                                <a href="{{ route('blog.view', $blog->id) }}" class="read_more text_inter"> Read more <i
                                        class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="swiper-slide">
                    <div class="blog_box">
                        <div class="blg_img">
                            <img src="{{ asset('frontend/images/image-1.jpg') }}" alt=""
                                class="img-fluid w-100">
                        </div>
                        <div class="blg_content">
                            <h2 class="blog_title text_hind text-uppercase"><a href="">How To Choose A dining
                                    tables</a></h2>
                            <span class="d-block blog_date text_hind text-uppercase">Jan 12th 2025</span>
                            <p class="blog_excrepts text_inter">Buying a wardrobe is a big decision. It’s not just a
                                piece of furniture; it’s a centrepiece that wi...</p>
                            <a href="" class="read_more text_inter"> Read more <i
                                    class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="blog_box">
                        <div class="blg_img">
                            <img src="{{ asset('frontend/images/image-3.jpg') }}" alt=""
                                class="img-fluid w-100">
                        </div>
                        <div class="blg_content">
                            <h2 class="blog_title text_hind text-uppercase"><a href="">How To Choose A dining
                                    tables</a></h2>
                            <span class="d-block blog_date text_hind text-uppercase">Jan 12th 2025</span>
                            <p class="blog_excrepts text_inter">Buying a wardrobe is a big decision. It’s not just a
                                piece of furniture; it’s a centrepiece that wi...</p>
                            <a href="" class="read_more text_inter"> Read more <i
                                    class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="blog_box">
                        <div class="blg_img">
                            <img src="{{ asset('frontend/images/image-4.jpg') }}" alt=""
                                class="img-fluid w-100">
                        </div>
                        <div class="blg_content">
                            <h2 class="blog_title text_hind text-uppercase"><a href="">How To Choose A dining
                                    tables</a></h2>
                            <span class="d-block blog_date text_hind text-uppercase">Jan 12th 2025</span>
                            <p class="blog_excrepts text_inter">Buying a wardrobe is a big decision. It’s not just a
                                piece of furniture; it’s a centrepiece that wi...</p>
                            <a href="" class="read_more text_inter"> Read more <i
                                    class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>



<section class="section seo_content">
    <div class="container text-center">
        <h2 class="text_hind">Affordable Home Furniture</h2>
        <p class="text_inter">Discover our full range of quality affordable furniture. Find home furniture pieces to
            complement every room in the house, and even outdoors. With a variety of options to suit you, add your
            personal touch with styles ranging from traditional to more contemporary and modern home furniture.</p>
        <p class="text_inter">Breathe new life into your living space with affordable living room furniture. From Coffee
            tables, Bookcases, TV Stands and Chairs, shop the full range of cheap home furniture online at MIDHA’S
            FURNITURE GALLERY now.</p>
    </div>
</section>
