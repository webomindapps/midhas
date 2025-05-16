<x-frontend.page>
    <section class="section breadcrumb pb-0 seo_content w-100">
        <div class="container text-start">
            <ul class="list_styled d-flex breadcrumb mb-5">
                <li><a href="{{ route('home') }}">Home<i class="fa-solid fa-chevron-right"></i></a></li>
                <li>Checkout</li>
            </ul>

            <h2 class="text_inter text-uppercase">Checkout Details</h2>
            <div class="checkout_progress position-relative d-flex align-items-center" style="--progress: 40%;">
                <p class="d-flex align-items-center"><i
                        class="fa-solid fa-check me-3 d-flex align-items-center justify-content-center"></i> View Cart
                </p>
                <p class="d-flex align-items-center"><i
                        class="fa-solid fa-check me-3 d-flex align-items-center justify-content-center"></i> Customer
                    Information</p>
                <p class="d-flex align-items-center"><i
                        class="number me-3 d-flex align-items-center justify-content-center">3</i> Order Summary &
                    Payment</p>
            </div>

        </div>
    </section>

    <section class="section checkout_form mt-4">
        <div class="container">
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf

                <!-- Shipping Information -->
                <div class="form_wrapper bg-light">
                    <h3 class="text_inter">Shipping Information</h3>
                    <div class="d-block mt-4" aria-labelledby="form-title">
                        <h2 id="form-title" class="visually-hidden">Form for Shipping Information</h2>
                        <x-frontend.checkout />
                    </div>
                </div>

                <!-- Location Type -->
                <div class="form_wrapper bg-light">
                    <h3 class="text_inter">Location Type</h3>
                    <div class="d-block mt-4" aria-labelledby="form-title">
                        <h2 id="form-title" class="visually-hidden">Form for Location Type</h2>

                        <div class="row">
                            <div class="col-md-6 a-d-name text-center">
                                <div class="radio-button">
                                    <input class="l-t-radio" type="radio" id="option1" name="location_type"
                                        value="residential">
                                    <label class="l-t-label" for="option1"><i class="fas fa-home"></i>&nbsp;
                                        Residential</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-center a-d-name">
                                <div class="radio-button">
                                    <input class="l-t-radio" type="radio" id="option2" name="location_type"
                                        value="commercial">
                                    <label class="l-t-label" for="option2"><i class="fas fa-building"></i>&nbsp;
                                        Commercial</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing Address -->
                <div class="form_wrapper bg-light">
                    <h3 class="text_inter">Billing Address</h3>
                    <div class="d-block mt-4" aria-labelledby="form-title">
                        <h2 id="form-title" class="visually-hidden">Form for Billing Address</h2>

                        <div class="row">
                            <div class="col-md-6 a-d-name text-start">
                                <div class="radio-button custom-radio">
                                    <input class="b-a-radio" type="radio" id="optionba1" name="isShippingInformation"
                                        value="1" onclick="toggleBillingAddress()">
                                    <span class="checkmark"></span>
                                    <label class="b-a-label" for="optionba1">Use Shipping information</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-start a-d-name">
                                <div class="radio-button custom-radio">
                                    <input class="b-a-radio" type="radio" id="optionba2" name="isShippingInformation"
                                        value="0" onclick="toggleBillingAddress()">
                                    <span class="checkmark"></span>
                                    <label class="b-a-label" for="optionba2">Use the information below</label>
                                </div>
                            </div>
                        </div>

                        <div id="billing-address" class="mt-3">
                            <x-frontend.checkout prefix="billing" />
                        </div>
                    </div>
                </div>

                <!-- Delivery Date and Order Summary -->
                <div class="form_wrapper bg-light">
                    <div class="col-md-12">
                        <div class="row justify-content-between">
                            <div class="col-lg-4 col-md-6">
                                <h3 class="text_inter">Choose Delivery Date</h3>
                                <div class="d-block mt-4" aria-labelledby="form-title">
                                    <h2 id="form-title" class="visually-hidden">Form for choose delivery date</h2>
                                    <input type="date" class="form-control" name="delivery_date"
                                        placeholder="Delivery Date" required>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-6">
                                <h3 class="text_inter">Order Summary</h3>
                                <div class="order-summary mt-4">
                                    <div class="d-flex pt-0 justify-content-between">
                                        <div class="col-text-start">Shipping Cost</div>
                                        <div class="col-text-end"><b>$00 CAD</b></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-text-start">Order sub-total</div>
                                        <div class="col-text-end"><b>${{ number_format($cart->total_amount, 2) }}</b>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-text-start">Tax</div>
                                        <div class="col-text-end"><b> ${{ number_format($cart->tax_total, 2) }}</b>
                                        </div>
                                    </div>
                                    <div class="total d-flex justify-content-between">
                                        <div class="col-text-start fs-2x fw-bold">Order Total</div>
                                        <div class="col-text-end"><b>${{ number_format($cart->grand_total, 2) }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="d-flex justify-content-md-end justify-content-center mt-4">
                    <a href="{{ route('cart') }}" class="dark_btn text-white me-4">Back</a>
                    <button type="submit" class="theme_btn text-white">Continue</button>
                </div>
            </form>
        </div>

    </section>
    <x-slot:scripts>

        <script>
            function toggleBillingAddress() {
                const selectedValue = document.querySelector('input[name="isShippingInformation"]:checked')?.value;
                const billingSection = document.getElementById('billing-address');

                if (selectedValue === "1") {
                    billingSection.style.display = 'none';
                    billingSection.querySelectorAll('input, select, textarea').forEach(input => {
                        input.required = false;
                    });
                } else if (selectedValue === "0") {
                    billingSection.style.display = 'block';
                    billingSection.querySelectorAll('input, select, textarea').forEach(input => {
                        input.required = true;
                    });
                }
            }

            // Optional: call on page load
            document.addEventListener('DOMContentLoaded', function() {
                toggleBillingAddress();
            });
        </script>

    </x-slot:scripts>
</x-frontend.page>
