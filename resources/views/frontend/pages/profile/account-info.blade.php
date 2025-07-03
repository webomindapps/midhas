<x-frontend.page>

    <x-frontend.my-profile>
        <h4 class="">Account Overview</h4>
        <p>Open & Recent Orders</p>

        <div class="bg-white border p-4 rounded shadow-sm product_boxSS mt-3">
            <div class="row">
                <div class="col-lg-9">
                    <h5 class="text-muted fw-bold">Order Incomplete</h5>
                    <p>Your order has been added to our system, but no payment has been taken.</p>

                    <p><strong>Order Ref:</strong> WEB61007</p>
                    <p><strong>Order Date:</strong> Wednesday 12th March 2025</p>
                    <p><strong>Total:</strong> £36.98 Inc. Delivery</p>
                </div>
                <div class="col-lg-3 my-4 text_inter">
                    <div class="mb-2">
                        <a href="" class="Order-btn d-block">View Order Details</a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="Order-btn  d-block">Download Invoice</a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="Order-btn  d-block">Add to Basket</a>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-start">
                <img src="./images/offer-1.jpg" class="me-3 img-thumbnail" alt="Product Image">
                <div>
                    <strong>Phoenix 3 Drawer Bedside Table</strong><br>
                    Colour: Black, Qty 1<br>
                    <strong>£32.99</strong>
                </div>
            </div>
        </div>
        <!-- Saved Baskets Section -->
        <div class="bg-white border p-4 rounded shadow-sm mt-4">
            <h6 class="fw-bold text-muted">Saved Baskets</h6>

            <div class="row justify-content-between align-items-start mt-3">
                <div class="col-lg-9">
                    <p class="mb-2">2 items saved on <strong>12 Mar 2025</strong></p>
                    <div class="d-flex gap-2">
                        <img src="./images/offer-1.jpg" class="img-thumbnail p-0" style="width:80px; height:80px;"
                            alt="Product 1">
                        <img src="./images/offer-1.jpg" class="img-thumbnail p-0" style="width:80px; height:80px;"
                            alt="Product 2">
                    </div>
                </div>

                <div class="col-lg-3 my-4 text_inter">
                    <p class="fw-bold">Sub Total: <span class="text-dark">£84.98</span></p>
                    <div class="mb-2">
                        <a href="" class="Order-btn d-block">RESUME BASKET</a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="Order-btn  d-block">VIEW BASKET</a>
                    </div>
                    <div class="mt-2">
                        <a href="#" class="text-decoration-none text-muted" style="font-size: 14px;">Remove
                            Basket</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white border p-4 rounded shadow-sm mt-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-bold text-muted mb-0">Default Address</h6>
                <a href="{{ route('customer.address') }}" class="text-decoration-none small">View Address Book</a>
            </div>
            <hr>

            <address class="text-muted" style="line-height: 1.7;">
                <ul class="list-unstyled">
                    <li> {{ $address->first_name . '.' . $address->last_name }}</li>
                    <li>{{ $address->address_1 }}</li>
                    <li>{{ $address->city }} </li>
                    <li> {{ $address->postal_code }}</li>
                    <li class="mt-3">{{ $address->province }}</li>
                    <li>{{ $address->phone_number }}</li>
                </ul>
            </address>
        </div>
        <div class=" p-4 rounded mt-4 text-center">
            <h4 class="mb-3">Recently Viewed Items:</h4>
            <div class="d-flex justify-content-center">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 mb-3">
                        <img src="./images/offer-1.jpg" alt="Recently Viewed Item" width="100%">
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-3">
                        <img src="./images/offer-1.jpg" alt="Recently Viewed Item" width="100%">
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-3">
                        <img src="./images/offer-1.jpg" alt="Recently Viewed Item" width="100%">
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-3">
                        <img src="./images/offer-1.jpg" alt="Recently Viewed Item" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </x-frontend.my-profile>
</x-frontend.page>
