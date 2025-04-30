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
                    <div class="row">
                        <div class="col-md-7">
                            <div class="cart_table">
                                <div class="cart_parameters d-md--block d-none">
                                    <ul class="list_styled d-flex bg-dark text-white text-center">
                                        <li>Product</li>
                                        <li>Price</li>
                                        <li>Quantity</li>
                                        <li>Total Amount</li>
                                    </ul>
                                </div>
                                <div class="cart_products">
                                    <ul class="list_styled d-md-flex d-block gx-4">
                                        <li class="cart_prd d-flex gx-4">
                                            <img src="images/prd-1.jpg" alt="">
                                            <div class="prd_name">
                                                <h3 class="mt-0 fw-bold">Verona Fabric Ottoman Bench</h3>
                                                <span><b>SKU:</b> #89943Q75</span>
                                            </div>
                                        </li>
                                        <li class="text-md-center text-start"><span
                                                class="fw-bold d-block px-1">$250.00</span></li>
                                        <li class="text-md-center text-start">
                                            <div class="number d-flex align-items-center">
                                                <p class="d-inline mb-0 me-2 fw-bold d-none">Qty</p>
                                                <x-qty-input :id="$product->id" />
                                            </div>
                                        </li>
                                        <li class="text-md-center text-start total"><span
                                                class="d-md-none d-inline-block fw-bold">Total:</span> <span
                                                class="fw-bold d-md-block d-inline-block px-1">$250.00</span></li>
                                    </ul>
                                    <div class="warranty bg-white py-4 col-lg-9 col-md-12">
                                        <h5><i class="fas fa-shield-alt"></i> Protection Plans</h5>
                                        <div class="row my-3">
                                            <div class="col-lg-4 col-6 a-d-name text-center">
                                                <div class="radio-button m-0">
                                                    <input class="l-t-radio" type="radio" id="option1"
                                                        name="radio-group">
                                                    <label class="l-t-label warrenty-label" for="option1">
                                                        No Extended Plan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <h6>General product protection coverage</h6>
                                        <div class="row mb-3">
                                            <div class="col-lg-4 col-6 text-center a-d-name">
                                                <div class="radio-button m-0">
                                                    <input class="l-t-radio" type="radio" id="option2"
                                                        name="radio-group">
                                                    <label class="l-t-label warrenty-label" for="option2">
                                                        2 Year - $49.99</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-6 text-center a-d-name">
                                                <div class="radio-button m-0">
                                                    <input class="l-t-radio" type="radio" id="option3"
                                                        name="radio-group">
                                                    <label class="l-t-label warrenty-label" for="option3">
                                                        3 Year - $79.99</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-6 text-center a-d-name">
                                                <div class="radio-button m-0">
                                                    <input class="l-t-radio" type="radio" id="option4"
                                                        name="radio-group">
                                                    <label class="l-t-label warrenty-label" for="option4">
                                                        4 Year - $104.99</label>
                                                </div>
                                            </div>
                                        </div>
                                        <h6>Premium product protection coverage</h6>
                                        <div class="row">
                                            <div class="col-lg-4 col-6 text-center a-d-name">
                                                <div class="radio-button m-0">
                                                    <input class="l-t-radio" type="radio" id="option5"
                                                        name="radio-group">
                                                    <label class="l-t-label warrenty-label" for="option5">
                                                        2 Year - $49.99</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-6 text-center a-d-name">
                                                <div class="radio-button m-0">
                                                    <input class="l-t-radio" type="radio" id="option6"
                                                        name="radio-group">
                                                    <label class="l-t-label warrenty-label" for="option6">
                                                        3 Year - $79.99</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
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
                                                <label class="b-a-label" for="optionba1"> Store/Warehouse Pickup</label>
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
                                        <div class="col-text-end"><b>$100 CAD</b></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-text-start">Tax</div>
                                        <div class="col-text-end"><b>HST: $100 CAD</b></div>
                                    </div>
                                    <div class="total d-flex justify-content-between">
                                        <div class="col-text-start fs-2x fw-bold">Order Total</div>
                                        <div class="col-text-end"><b>$100 CAD</b></div>
                                    </div>
                                </div>
                                <div class="d-flex mt-4 justify-content-md-end justify-content-center">
                                    <a href="listing.php" class="dark_btn text-white me-4"> Continue Shopping</a>
                                    <a href="checkout.php" class="theme_btn text-white"> Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-app-layout>
