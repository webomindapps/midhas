<div class="">
    @if (is_null($products) || count($products) == 0)
        <p class="text-center mb-0">No Result Found</p>
    @else
        @foreach ($products as $product)
            @if ($product->status)
                <li>
                    <div class="row align-items-center">
                        <div class="col-lg-1 col-3">
                            @if (count($product->images))
                                <img src="{{ $product->thumbnail }}" loading="lazy" alt="product"
                                    class="img-fluid img-responsive">
                            @else
                                <img src="{{ asset('frontend/assets/images/default.png') }}" loading="lazy" alt="product"
                                    class="img-fluid img-responsive">
                            @endif
                        </div>
                        <div class="col-lg-6 col-6">
                            <a href="{{ route('productByCategory', $product->slug) }}">
                                <div class="pct-desc">
                                    <p class="mb-0">
                                        {{ $product->title }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-3 text-center">
                            <div class="search-price">${{ number_format($product->msrp ?? 0, 2) }}</div>
                        </div>
                        {{-- <div class="col-lg-3 col-5 text-center">
                            <input type="number" name="product_quantity" value="1" style="width: 50px;">
                            <x-qty-input :id="$product->id" />
                        </div> --}}
                        <div class="col-lg-2  col-4 text-center my-auto">
                            @if ($product->total_stock > 0 && !$product->is_outof_stock)
                                <a class="search-btn-cart addToCart" data-id="{{ $product->id }}">
                                    Cart <i class='bx bx-cart-alt'></i>
                                </a>
                            @else
                                <a class="search-btn-cart bg-danger">
                                    <i class='bx bx-message-square-x'></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endif
        @endforeach
    @endif
</div>
