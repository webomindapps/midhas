<x-frontend.page>
    <section class="section breadcrumb pb-0 seo_content w-100">
        <div class="container text-start">
            <ul class="list_styled d-flex breadcrumb mb-5">
                <li><a href="{{ url('/') }}">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                <li>Cart</li>
            </ul>

            <h2 class="text_inter text-uppercase">Cart</h2>
            <div class="checkout_progress position-relative d-flex align-items-center" style="--progress: 5%;">
                <p class="d-flex align-items-center">
                    <i class="fa-solid fa-check me-3 d-flex align-items-center justify-content-center"></i> View Cart
                </p>
                <p class="d-flex align-items-center">
                    <i class="number me-3 d-flex align-items-center justify-content-center">2</i> Customer Information
                </p>
                <p class="d-flex align-items-center">
                    <i class="number me-3 d-flex align-items-center justify-content-center">3</i> Order Summary &
                    Payment
                </p>
            </div>

        </div>
    </section>

    <section class="section checkout_form mt-4">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                        <div class="cart_table">
                            @forelse ($cartItems as $cart)
                                @foreach ($cart->items as $item)
                                    <div class="cart_products">
                                        <ul class="list_styled d-md-flex d-block gx-4">
                                            <li class="cart_prd d-flex gx-4">
                                                <img src="{{ asset($item->product->thumbnail) }}"
                                                    alt="{{ $item->name }}">
                                                <div class="prd_name">
                                                    <h3 class="mt-0 fw-bold">{{ $item->name }}</h3>
                                                    <span><b>SKU:</b> #{{ $item->sku }}</span>
                                                </div>
                                            </li>
                                            <li class="text-md-center text-start"><span
                                                    class="fw-bold d-block px-1">${{ number_format($item->price ?? 0, 2) }}</span>
                                            </li>
                                            <li class="text-md-center text-start">
                                                <div class="number d-flex align-items-center">
                                                    <p class="d-inline mb-0 me-2 fw-bold d-none">Qty</p>
                                                    <div
                                                        class="input-group justify-content-md-center justify-content-start">
                                                        <input type="button" value="-" data-field="quantity"
                                                            class="button-minus" fdprocessedid="1d819l"
                                                            data-id="{{ $item->id }}">
                                                        <input type="text" step="1" max=""
                                                            value="{{ $item->quantity }}" name="quantity"
                                                            class="quantity-field crtItmQty"
                                                            data-id="{{ $item->id }}"
                                                            data-price="{{ $item->price }}"
                                                            data-stock="{{ $item->product->total_stock }}">
                                                        <input type="button" value="+" data-field="quantity"
                                                            class="button-plus" fdprocessedid="efqtyq"
                                                            data-id="{{ $item->id }}">
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="text-md-center text-start total">
                                                <span class="d-md-none d-inline-block fw-bold">Total:</span>
                                                <span class="fw-bold d-md-block d-inline-block px-1 item-total">
                                                    ${{ number_format($item->total_amount ?? $item->price * $item->quantity, 2) }}
                                                </span>
                                            </li>
                                            <li class="text-md-center text-start total">
                                                <a href="{{ route('delete-cart', $item->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class='bx bx-trash' style="color: red; cursor: pointer;"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            @empty
                                <p>No items in your cart.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-md-5">
                        @if ($cartItems->isNotEmpty())
                            @php
                                $cart = $cartItems->first();
                            @endphp
                            <div class="form_wrapper position-sticky top-0 bg-light pickup_opt">
                                <h3 class="text_inter">Delivery/Pickup Options</h3>
                                <div class="coupon-section mt-4 d-flex">
                                    <input type="text" class="form-control" id="coupon-input"
                                        placeholder="Enter Cupon code">
                                    <button id="apply-coupon-button"
                                        class="btn theme_btn rounded-0 text-white">Apply</button>
                                </div>
                                <div class="order-summary mb-4">
                                    <div class="d-flex pt-0 justify-content-between">
                                        <div class="col-text-start">
                                            <div class="radio-button custom-radio">
                                                <input class="b-a-radio" type="radio" id="optionba1"
                                                    name="radio-group">
                                                <span class="checkmark"></span>
                                                <label class="b-a-label" for="optionba1"> Store/Warehouse
                                                    Pickup</label>
                                            </div>
                                        </div>
                                        <div class="col-text-end"><b>$100 CAD</b></div>
                                    </div>
                                    <div class="d-flex justify-content-between pb-0">
                                        <div class="col-text-start">
                                            <div class="radio-button custom-radio">
                                                <input class="b-a-radio" type="radio" id="optionba2"
                                                    name="radio-group">
                                                <span class="checkmark"></span>
                                                <label class="b-a-label" for="optionba2"> Home Delivery</label>
                                            </div>
                                        </div>
                                        <div class="col-text-end"><b>HST: $100 CAD</b></div>
                                    </div>
                                </div>
                                <h3 class="text_inter">Order Summary</h3>
                                <div class="order-summary mt-4">
                                    <div class="d-flex pt-0 justify-content-between">
                                        <div class="col-text-start">Order sub-total</div>
                                        <div class="col-text-end" id="sub_total">
                                            <b>${{ number_format($cart->total_amount, 2) }}
                                            </b>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-text-start">Tax</div>
                                        <div class="col-text-end tax_total"><b id="tax_total">
                                                ${{ number_format($cart->tax_total, 2) }}
                                            </b>
                                        </div>
                                        {{-- {{ dd($cart->tax_total) }} --}}
                                    </div>
                                    <div class="total d-flex justify-content-between">
                                        <div class="col-text-start fs-2x fw-bold">Order Total</div>
                                        <div class="col-text-end ">
                                            <b id="grand_total">${{ number_format($cart->grand_total, 2) }}
                                            </b>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 justify-content-md-end justify-content-center">
                                    <a href="{{ route('home') }}" class="dark_btn text-white me-4"> Continue
                                        Shopping</a>
                                    <a href="checkot.html" class="theme_btn text-white"> Checkout</a>
                                </div>

                            </div>
                        @endif
                    </div>

                </div>
            </div>
    </section>
    <x-slot:scripts>
        <script>
            $(document).on('click', '.quantity .quantity-btn, .button-plus, .button-minus', function() {
                var $input = $(this).closest('.input-group').find('.quantity-field');
                var currentQty = parseInt($input.val());
                var stock = parseInt($input.data('stock'));

                if ($(this).hasClass('button-plus') || $(this).hasClass('quantity-plus')) {
                    if (currentQty < stock) {
                        $input.val(currentQty + 1).trigger('change');
                    } else {
                        window.FlashMessage?.error?.('Cannot add more than available stock.', {
                            timeout: 2000,
                            progress: true
                        });
                    }
                }

                if ($(this).hasClass('button-minus') || $(this).hasClass('quantity-minus')) {
                    if (currentQty > 1) {
                        $input.val(currentQty - 1).trigger('change');
                    }
                }
            });


            $(document).on('change', '.crtItmQty', function() {
                var $this = $(this);
                var qty = parseInt($this.val()) || 1;
                var item_id = $this.data('id');
                var item_price = parseFloat($this.data('price')) || 0;

                var totalTr = $this.closest('ul').find('.item-total');
                let url = window.location.origin + "/cart/update";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        item_id: item_id,
                        qty: qty,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            if (typeof calculate === 'function') {
                                calculate(response.cart);
                            }

                            $('.cart_updated').show();

                            let total = qty * item_price;
                            totalTr.html('$' + total.toFixed(2));

                            if (window.FlashMessage) {
                                window.FlashMessage.success('Cart updated successfully', {
                                    timeout: 3000,
                                    pauseOnHover: true,
                                    progress: true
                                });
                            }
                        } else {
                            if (window.FlashMessage) {
                                window.FlashMessage.warning(response.message || 'Could not update cart', {
                                    timeout: 3000
                                });
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);

                        if (window.FlashMessage) {
                            window.FlashMessage.error('Something went wrong. Please try again.', {
                                timeout: 3000
                            });
                        }
                    },
                    complete: function() {
                        $('.enquire-btn').prop('disabled', false);
                    }
                });
            });

            function calculate(cart) {
                $('#sub_total').html('$' + cart.total_amount.toFixed(2));
                $('#tax_total').html(' $' + cart.tax_total.toFixed(2));
                $('#grand_total').html('$' + cart.grand_total.toFixed(2));
                $('#tax').html('$' + cart.tax.toFixed(2));

                if (cart.total_amount > 1) {
                    $('.checkout-btn').removeClass('disabled');
                    $('.minimum-msg').hide();
                } else {
                    $('.checkout-btn').addClass('disabled');
                    $('.minimum-msg').show();
                }
            }
        </script>
    </x-slot:scripts>
</x-frontend.page>
