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
                <div class="row">
                    @if ($cart->type == 'delivery')
                        <div class="col-md-4">
                            <div class="col-4 mb-3">
                                <label class="mb-1">Delivery City</label>
                                <input type="text" class="form-control" name="delivery_city"
                                    value="{{ $delivery_city }}" id="delivery_city" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="mb-1">Delivery price ($)</label>
                                <input type="text" class="form-control" name="delivery_price"
                                    value="{{ $cart->price }}" readonly>
                            </div>
                        </div>
                    @else
                        <div class="col-md-8">
                            <div class="col-3 mb-3">
                                <label class="mb-1">Pickup Location</label>
                                <input type="text" class="form-control" value="{{ $cart->city }}" readonly>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="mb-1">Booked date & time</label>
                                <a href="{{ route('book-time') }}">Change Time</a>
                            </div>
                            <input type="text" class="form-control" name="delivery_city"
                                value="{{ $cart->time }} , {{ date('d-m-Y', strtotime($cart->date)) }}" readonly>
                        </div>
                    </div>
                </div>
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
                                        value="residential" checked>
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
                                <label class="radio-button custom-radio">
                                    <input class="b-a-radio" type="radio" id="optionba1" name="isShippingInformation"
                                        value="1" checked>
                                    <span class="checkmark"></span>
                                    Use Shipping information
                                </label>
                            </div>
                            <div class="col-md-6 text-start a-d-name">
                                <label class="radio-button custom-radio">
                                    <input class="b-a-radio" type="radio" id="optionba2"
                                        name="isShippingInformation" value="0">
                                    <span class="checkmark"></span>
                                    Use the information below
                                </label>
                            </div>
                        </div>


                        <div id="billing-address" class="mt-3" style="display: none;">
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
                                        <div class="col-text-end">
                                            <b>${{ Midhas::formatPrice($cart->total_amount, 2) }}</b>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-text-start">Tax</div>
                                        <div class="col-text-end"><b>
                                                ${{ Midhas::formatPrice($cart->tax_total, 2) }}</b>
                                        </div>
                                    </div>
                                    <div class="total d-flex justify-content-between">
                                        <div class="col-text-start fs-2x fw-bold">Order Total</div>
                                        <div class="col-text-end">
                                            <b>${{ Midhas::formatPrice($cart->grand_total, 2) }}</b>
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

                if (!billingSection) return;

                if (selectedValue === "1") {
                    billingSection.style.display = 'none';
                    billingSection.querySelectorAll('input, select, textarea').forEach(el => el.required = false);
                } else {
                    billingSection.style.display = 'block';
                    billingSection.querySelectorAll('input, select, textarea').forEach(el => el.required = true);
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('input[name="isShippingInformation"]').forEach(radio => {
                    radio.addEventListener('change', toggleBillingAddress);
                });

                toggleBillingAddress();
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZuRJggt3Hg37Vrl5EeL9j9FREsD7SBo8&libraries=places">
        </script>

        <script>
            $(document).ready(function() {
                const componentForm = {
                    administrative_area_level_1: "long_name",
                    postal_code: "short_name",
                    locality: "long_name"
                };
                var localeKeyword = "Toronto"
                var searchInput = ['shipping', 'billing'];

                searchInput.forEach((element) => {
                    let autocomplete;
                    let thiss = this;

                    autocomplete = new google.maps.places.Autocomplete((document.getElementById(
                        `${element}_address_1`)), {
                        strictBounds: false,
                        types: ['establishment', 'geocode'],
                        componentRestrictions: {
                            country: "CA"
                        },
                        fields: ['address_components'],
                    });

                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        for (const component of place.address_components) {
                            const addressType = component.types[0];
                            console.log(addressType);
                            if (componentForm[addressType]) {
                                const val = component[componentForm[addressType]];
                                $(`#${element}_${addressType}`).val(val);
                            }
                            if (addressType == 'postal_code') {
                                var number = component[componentForm[addressType]].replace(/\s+/g, '')
                                if (number.length == 6) {
                                    number = number.replace(/^(.{3})(.{3})$/, "$1 $2");
                                } else if (number.length > 6) {
                                    number = number.substring(0, 6)
                                    number = number.replace(/^(.{3})(.{3})$/, "$1 $2");
                                }
                                this.pin = number.substring(0, 7);
                                $(`#${element}_postal_code`).val(number.substring(0, 7));
                            }
                        }
                    });
                })
            });
        </script>

    </x-slot:scripts>
</x-frontend.page>
