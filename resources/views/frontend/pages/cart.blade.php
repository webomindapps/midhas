<x-app-layout>
    @section('main-content')
        <section class="section breadcrumb pb-0 seo_content w-100">
            <div class="container text-start">
                <ul class="list_styled d-flex breadcrumb mb-5">
                    <li><a href="{{ url('/') }}">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                    <li>Cart</li>
                </ul>

                <h2 class="text_inter text-uppercase">Cart</h2>
                <div class="checkout_progress position-relative d-flex align-items-center" style="--progress: 5%;">
                    <p class="d-flex align-items-center"><i
                            class="fa-solid fa-check me-3 d-flex align-items-center justify-content-center"></i> View Cart
                    </p>
                    <p class="d-flex align-items-center"><i
                            class="number me-3 d-flex align-items-center justify-content-center">2</i> Customer Information
                    </p>
                    <p class="d-flex align-items-center"><i
                            class="number me-3 d-flex align-items-center justify-content-center">3</i> Order Summary &
                        Payment</p>
                </div>

            </div>
        </section>

        <section class="section checkout_form mt-4">
            <div class="container">

                <div class="col-md-12">

                    {{-- {{ dd($cartItems) }} --}}
                    {{-- {{ dd($item->variant) }} --}}
                    <div class="row">

                        <div class="col-md-7">
                            <div class="cart_table">
                                <div class="cart_parameters d-md-block d-none">
                                    <table class="w-100 text-center align-middle" style="border-collapse: collapse;">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        @forelse ($cartItems as $cart)
                                            @foreach ($cart->items as $item)
                                                <tbody>
                                                    <tr class="mt-4">
                                                        <td class="cart_prd d-flex gap-3 align-items-center">
                                                            <div class="prd-img" style="width: 100px;">
                                                                @if (count($item?->product->images))
                                                                    <img src="{{ asset($item->product->images[0]->url) }}"
                                                                        class="img-fluid w-100" alt="{{ $item->name }}">
                                                                @else
                                                                    <img src="{{ asset('frontend/assets/images/default.png') }}"
                                                                        class="img-fluid w-100" alt="{{ $item->name }}">
                                                                @endif
                                                            </div>
                                                            <div class="prd_name">
                                                                <h6 class="fw-bold mb-1">{{ $item->name }}
                                                                    @if ($item->variant)
                                                                        <strong class="ms-2">
                                                                            ({{ $item->variant->value }})
                                                                        </strong>
                                                                    @endif
                                                                </h6>
                                                                <small><b>SKU:</b> {{ $item->sku }}</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="fw-bold">${{ number_format($item->price ?? 0, 2) }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <div class="input-group" style="width: 120px;">
                                                                    <input type="button" value="-"
                                                                        class="button-minus btn btn-outline-secondary"
                                                                        data-id="{{ $item->id }}">
                                                                    <input type="text" step="1" min="1"
                                                                        value="{{ $item->quantity }}" name="quantity"
                                                                        class="form-control quantity-field crtItmQty text-center"
                                                                        data-id="{{ $item->id }}"
                                                                        data-price="{{ $item->price }}">
                                                                    <input type="button" value="+"
                                                                        class="button-plus btn btn-outline-secondary"
                                                                        data-id="{{ $item->id }}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="fw-bold item-total">
                                                                ${{ number_format($item->total_amount ?? $item->price * $item->quantity, 2) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('delete-cart', $item->id) }}"
                                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                                <i class='bx bx-trash'
                                                                    style="color: red; cursor: pointer;"></i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        @empty
                                            <p>No items in your cart.</p>
                                        @endforelse
                                    </table>
                                </div>
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
                                            placeholder="Enter postal code">
                                        <button id="apply-coupon-button" class="btn theme_btn rounded-0 text-white">Show
                                            Options</button>
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
    @endsection
    @push('scripts')
        {{-- <script>
            $(document).on("click", ".qtyIncrement", function() {
                var id = $(this).data("id");
                var currentValue = parseInt($(`#quantity-${id}`).val()) || 1;

                $(`.quantity-${id}`).val(currentValue + 1).trigger('change');
            });

            $(document).on("click", ".qtyDecrement", function() {
                var id = $(this).data("id");
                var currentValue = parseInt($(`#quantity-${id}`).val()) || 1;

                if (currentValue > 1) {
                    $(`.quantity-${id}`).val(currentValue - 1).trigger('change');
                }
            });
        </script> --}}
        <script>
            $(document).on('click', '.button-plus, .button-minus', function() {
                const $input = $(this).siblings('.quantity-field');
                let qty = parseInt($input.val()) || 1;

                if ($(this).hasClass('button-plus')) {
                    qty++;
                } else {
                    if (qty > 1) qty--;
                }

                $input.val(qty).trigger('change');
            });

            $(document).on('click', '.quantity .quantity-btn', function() {
                var $input = $(this).closest('.quantity').find('.input-text');

                if ($(this).hasClass('quantity-plus')) {
                    $input[0].stepUp();
                    $input.trigger('change');
                }

                if ($(this).hasClass('quantity-minus')) {
                    if ($input.val() > 1) {
                        $input[0].stepDown();
                        $input.trigger('change');
                    }
                }
            });

            $(document).on('change', '.crtItmQty', function() {
                var $this = $(this);
                var qty = parseInt($this.val()) || 1; // fallback to 1 if NaN
                var item_id = $this.data('id');
                var item_price = parseFloat($this.data('price')) || 0;

                var totalTr = $this.closest('tr').find('.item-total'); // assumes you're using <tr><td> layout

                let url = window.location.origin + "/cart/update";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        item_id: item_id,
                        qty: qty,
                        _token: $('meta[name="csrf-token"]').attr('content') // safer than inline blade
                    },
                    success: function(response) {
                        if (response.success) {
                            if (typeof calculate === 'function') {
                                calculate(response.cart); // update totals if function exists
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
                $('#sub_total').html('<b>$' + cart.total_amount.toFixed(2) + '</b>');
                $('#tax_total').html('<b>HST: $' + cart.tax_total.toFixed(2) + '</b>');
                $('#grand_total').html('<b>$' + cart.grand_total.toFixed(2) + '</b>');
                $('#tax').html('$' + cart.tax.toFixed(2)); // optional if you have a #tax element elsewhere

                if (cart.total_amount > 1) {
                    $('.checkout-btn').removeClass('disabled');
                    $('.minimum-msg').hide();
                } else {
                    $('.checkout-btn').addClass('disabled');
                    $('.minimum-msg').show();
                }
            }
        </script>
    @endpush
</x-app-layout>
