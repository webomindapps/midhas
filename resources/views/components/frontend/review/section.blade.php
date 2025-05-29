@props(['product'])

<div class="review-sec">
    <div class="review-product-detail border-bottom pb-4">
        <div class="row mt-lg-5">
            <div class="col-lg-7 rating-dist">
                <div class="card">
                    <h3 class="card-title py-2">Ratings Distribution</h3>

                    <div class="rating-percents">
                        <div class="rating-percent">
                            <span class="rating-no">5 star</span>
                            <div class="range">
                                <input type="range" value="70" min="0" max="100" step="1"
                                    disabled />
                            </div>
                            <span class="rating-percent-no">102</span>
                        </div>
                        <div class="rating-percent">
                            <span class="rating-no">4 star</span>
                            <div class="range">
                                <input type="range" value="40" min="0" max="100" step="1"
                                    disabled />
                            </div>
                            <span class="rating-percent-no">9</span>
                        </div>
                        <div class="rating-percent">
                            <span class="rating-no">3 star</span>
                            <div class="range">
                                <input type="range" value="30" min="0" max="100" step="1"
                                    disabled />
                            </div>
                            <span class="rating-percent-no">3</span>
                        </div>
                        <div class="rating-percent">
                            <span class="rating-no">2 star</span>
                            <div class="range">
                                <input type="range" value="4" min="0" max="100" step="1"
                                    disabled />
                            </div>
                            <span class="rating-percent-no">1</span>
                        </div>
                        <div class="rating-percent">
                            <span class="rating-no">1 star</span>
                            <div class="range">
                                <input type="range" min="0" max="0" disabled />
                            </div>
                            <span class="rating-percent-no">0</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5 mt-lg-5">
                <div class="review-photos">
                    @foreach ($product->reviews as $review)
                        @foreach ($review->images as $image)
                            <div class="review-img">
                                <a data-fancybox="product-images" href="{{ asset('storage/' . $image->url) }}">
                                    <img src="{{ asset('storage/' . $image->url) }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>


        {{-- reviews --}}

        <div class="row bg-light pt-3 pb-3">
            <div class="col-lg-9 col-md-6 my-auto">
                <h5 class="mb-0">Reviewed by {{ count($product->reviews) }} customers</h5>
            </div>
            <div class="col-lg-3 col-md-6">
                <select name="" id="" class="form-select">
                    <option value="newest">Most Recent</option>
                    <option value="mosthelpful">Most Helpful</option>
                    <option value="lowestrating">Lowest Rated</option>
                    <option value="highestrating">Highest Rated</option>
                    <option value="oldest">Oldest</option>
                    </optgroup>
                </select>
            </div>
        </div>

        @foreach ($product->reviews as $review)
            <x-frontend.review.item :review="$review" />
        @endforeach


    </div>
    {{ $slot }}
</div>
