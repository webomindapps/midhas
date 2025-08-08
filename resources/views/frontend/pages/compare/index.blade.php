<x-frontend.page>
    <div class="col-12">
        <div class="row py-5">
            <h2 class="text-center">Product comparison</h2>
        </div>
        @if (count($compares) > 0)
            <div class="col-12  mb-5">
                <div class="product-compare-main">
                    <div class="product_comparison ms-5">

                        <div class="comparison-row">

                            <div class="compare-col">
                                <div class="comp-wrapper">
                                    <h5>Compare</h5>
                                    <ul>
                                        @foreach ($compares as $compare)
                                            @php
                                                $product = $compare->product;
                                            @endphp
                                            <li><a>{{ $product->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <p>{{ count($compares) }} items</p>
                                </div>
                            </div>


                            @foreach ($compares as $compare)
                                @php
                                    $product = $compare->product;
                                @endphp
                                <div class="compare-col">
                                    <div class="comp-wrapper">
                                        <div class="comp-close">
                                            <a class="removeFromCompare" data-id="{{ $compare->id }}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                        <div class="comp-img">
                                            <img src="{{ $product->thumbnail }}" alt="">
                                        </div>
                                        <div class="comp-product-desc">
                                            <p class="product_name">
                                                <a href="">
                                                    {{ $product->name }}
                                                </a>
                                            </p>

                                            <h6 class="price">
                                                <span class="online_price">Online Price</span>
                                                <span class="tt_price">${{ $product->currentPrice() }}</span>
                                                <span class="scratch_price"><s>${{ $product->msrp }}</s></span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="comparison-row">
                            <div class="compare-col">
                                <div class="comp-wrapper">
                                    <h5>Model Number</h5>
                                </div>
                            </div>
                            @foreach ($compares as $compare)
                                @php
                                    $product = $compare->product;
                                @endphp
                                <div class="compare-col">
                                    <div class="comp-wrapper">
                                        <h6>{{ $product->sku }}</h6>
                                    </div>
                                </div>
                            @endforeach



                        </div>
                        <div class="comparison-row">
                            <div class="compare-col">
                                <div class="comp-wrapper">
                                    <h5>Ratings & Reviews</h5>
                                </div>
                            </div>

                            @foreach ($compares as $compare)
                                @php
                                    $product = $compare->product;
                                    $totalReviews = count($product->reviews);
                                    $totalRatings = $product->reviews()->sum('rating');
                                @endphp
                                <div class="compare-col">
                                    <div class="comp-wrapper">
                                        <div class="comp-rating">
                                            <div class="comp-star">
                                                @if ($totalReviews != 0)
                                                    {{ round($totalRatings / $totalReviews) }}
                                                @else
                                                    0
                                                @endif <i class="fas fa-star"></i>
                                            </div>
                                            <div class="productRating">
                                                {{ $totalRatings }} Ratings &
                                                {{ $totalReviews }} Reviews
                                            </div>
                                            <div class="AllReview">
                                                <a href=""> All
                                                    {{ $totalReviews }} reviews</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="comparison-row">
                            <div class="compare-col">
                                <div class="comp-wrapper">
                                    <h5>Warranty</h5>
                                </div>
                            </div>
                            @foreach ($compares as $compare)
                                @php
                                    $product = $compare->product;
                                @endphp
                                <div class="compare-col">
                                    <div class="comp-wrapper">
                                        <ul>

                                            {{-- @foreach ($product->warranties as $warranty)
                                                <li>
                                                    Protect your purchase for {{ $warranty->no_of_months }} months:
                                                    <span
                                                        class="text-danger">${{ Teletime::formatPrice($warranty->price) }}
                                                    </span>
                                                </li>
                                            @endforeach --}}

                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="comparison-row">
                            <div class="compare-col">
                                <div class="comp-wrapper">
                                    <h5>Filter by Category</h5>
                                </div>
                            </div>
                            @foreach ($compares as $compare)
                                @php
                                    $product = $compare->product;
                                @endphp
                                <div class="compare-col">
                                    <div class="comp-wrapper">
                                        @foreach ($product->categories as $category)
                                            <h6> {{ $category->name }} </h6>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="comparison-row">
                            <div class="compare-col">
                                <div class="comp-wrapper">
                                    <h5>Brand</h5>
                                </div>
                            </div>
                            @foreach ($compares as $compare)
                                @php
                                    $product = $compare->product;
                                @endphp
                                <div class="compare-col">
                                    <div class="comp-wrapper">
                                        <h6>{{ $product->brand?->name }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        @foreach ($specifications as $specification)
                            <div class="comparison-row">
                                <div class="compare-col">
                                    <div class="comp-wrapper">
                                        <h5>{{ $specification->name }}</h5>
                                    </div>
                                </div>
                                @foreach ($compares as $compare)
                                    @php
                                        $product = $compare->product;
                                        $value = $product
                                            ->specifications()
                                            ->where('product_id', $compare->product_id)
                                            ->where('specification_id', $specification->id)
                                            ->first();
                                    @endphp
                                    <div class="compare-col">
                                        <div class="comp-wrapper">
                                            <h6>
                                                {{ $value ? $value->value : '' }}
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach


                        {{-- <div class="comparison-row">
                            <div class="compare-col">
                                <div class="comp-wrapper">
                                    <h5></h5>
                                </div>
                            </div>


                            @foreach ($compares as $compare)
                                @php
                                    $product = $compare->product;
                                @endphp
                                <div class="compare-col">
                                    <div class="comp-wrapper add-it">
                                        <a class="btn add-cart btnCart" data-id="{{ $product->id }}" style="width: 100%">
                                            <span id="add-to-cart">
                                                <svg xmlns="http://www.w3.org/2000/svg" version="1.0"
                                                    viewBox="0 0 180 180" width="20" height="20">
                                                    <path
                                                        d="M80 1660c-11-11-20-29-20-40 0-42 34-60 114-60 41 0 77-4 81-9 3-6 64-209 135-451 72-243 136-454 144-468 19-36 44-58 89-77 30-12 95-15 399-15 348 0 363 1 406 21 25 12 53 37 67 58 21 32 185 606 185 647 0 8-9 23-20 34-20 20-33 20-615 20H451l-21 73c-54 182-63 208-83 233-30 39-76 54-167 54-67 0-83-3-100-20zM675 411c-45-20-70-60-70-112 0-42 5-53 33-81 47-48 117-48 164 0 28 28 33 39 33 82 0 42-5 54-31 81-33 33-92 46-129 30zM1275 411c-45-20-70-60-70-112 0-42 5-53 33-81 47-48 117-48 164 0 28 28 33 39 33 82 0 42-5 54-31 81-33 33-92 46-129 30z"
                                                        transform="matrix(.1 0 0 -.1 0 180)"></path>
                                                </svg> &nbsp;
                                                Add To Cart
                                            </span>
                                            <i id="loader" class="fa fa-spinner fa-spin loader"
                                                aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div> --}}


                    </div>
                </div>
            </div>
        @else
            <div class="col-12  mb-5 text-center">
                <h6>No Products to show</h6>
            </div>
        @endif

    </div>
</x-frontend.page>
